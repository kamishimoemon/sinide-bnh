<?php
namespace sinide\bnh;

use sinide\bnh\io\Path;
use sinide\bnh\io\ZipPath;
use sinide\bnh\io\BnhFile;
use sinide\bnh\persistence\Database;
use sinide\bnh\exception\NoFileToProcess;

class DefaultProcess
	implements Process
{
	private $db;
	private $id;
	private $state;
	private $stateChange;

	public function __construct (Database $db)
	{
		/*
		$rs = $db->findOne('
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
		');
		*/
		$rs = [
			'id_importacion' => '54',
			'?column?' => '15380toba',
			'archivo_upload' => 'C:\Users\Dario\workspace\SIU\proyectos\pedidos_3_3\php\importadores\nuevo\temp\42471-advertencia.zip',
			'nombre_archivo' => 'datos.txt',
			'tabla_final' => 'base_alumnos',
			'cod_pedido' => '15380',
			'nombre_usuario' => 'toba',
		];

		if (!$rs) throw new NoFileToProcess();

		$this->db = $db;
		$this->id = intval($rs['id_importacion']);
		$this->state = new PreProcessState(
			$this,
			new BnhFile(
				new ZipPath(
					new Path($rs['archivo_upload']),
					new Path($rs['nombre_archivo'])
				)
			),
			$db
		);

		$sql = 'UPDATE importaciones SET id_importacion_estado = $1 WHERE id_importacion = $2';
		$this->stateChange = $db->prepare($sql);
	}

	public function run (): void
	{
		$this->state->run();
	}

	public function setState (ProcessState $newState): void
	{
		$this->stateChange->run([$newState->id(), $this->id]);
		$this->state = $newState;
		$newState->run();
	}
}