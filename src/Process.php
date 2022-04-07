<?php
namespace sinide\bnh;

class Process
{
	private $id;
	private $state;

	public function __construct (Database $db)
	{
		$rs = $db->findOne("
			SELECT
				id_importacion,
				cod_pedido||nombre_usuario,
				archivo_upload,
				nombre_archivo,
				tabla_final,
				cod_pedido,
				nombre_usuario
			FROM importaciones
			WHERE id_importacion_estado = 9
			ORDER BY id_importacion ASC
			LIMIT 1
		");

		if (!$rs) throw new NoHayArchivoParaImportar();

		$this->id = intval($rs["id_importacion"]);
		$this->state = new EnPreImportacion(
			$this,
			new ArchivoBnh(
				new ZipPath(
					new Path($rs["archivo_upload"]),
					new Path($rs["nombre_archivo"])
				)
			)
		);
	}

	public function id (): int
	{
		return $this->id;
	}

	public function run (): void
	{
		$this->state->procesar();
	}

	public function cambioEstado (EstadoImportacion $state): void
	{
		$this->state = $state;
		$state->cambioEstado();
	}
}