# sinide-bnh

## TODOS:
 - [X] Add a timer
 - [ ] Read configuration from .ini file
 - [X] Processes should run one at a time
 - [ ] At the start of process, it's state should change to "on analysis"
 - [ ] Create temporal table
 - [ ] Create errors temporal table
 - [ ] Create rectified temporal table
 - [ ] Read zipped data to process
 - [ ] Validate data, update process metrics
 - [ ] Copy valid data into temporal table
 - [ ] Rectify data
 - [ ] Check for duplicated data
 - [ ] Check for duplication between new and old data
 - [ ] Copy data into definitive table
 - [ ] Update process metrics
 - [ ] Drop temporary tables
 - [ ] If there are warnings:
		- [ ] Persist warnings
		- [ ] Change process state to "Finished with warnings"
 - [ ] If there are no warnings, change process state to "OK"
 - [ ] If there is rectified and duplicate data, undo rectification
 - [ ] ~~Add subcommand "unlock" to delete lock file?~~