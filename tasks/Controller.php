<?php
namespace Task;

class Controller
{ 
    private static $db;

    public function __construct($db = null)
    {
        $this->db = $db;
    }

    public function getAll()
    {
    	$result = $this->db->query('SELECT * FROM tasks order by sort_order asc');
	
		$tasks = array();

		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$tasks[] = $row;
		}

		if (!empty($tasks)) {
	   		return json_encode($tasks);
	   	}
	   	else {
	   		return "Wow. You have nothing else to do. Enjoy the rest of your day!";   		
	   	}
    }    

    public function getByUUID($uuid = null)
    {
    	$result = $this->db->query('SELECT * FROM tasks where uuid = ' . $uuid);
	
   		return json_encode($result->fetch_array(MYSQLI_ASSOC));
    }

    public function insert($task = [])
    {
    	//cast object
    	if ( (!empty((array) $task)) && ($task->content !== "") ) {
			if ( ($task->type == "shopping") || ($task->type == "work") ) {
				$result = $this->db->query('INSERT INTO tasks(type, content, sort_order, done)
											VALUES ("' . $task->type .'", 
											  		"' . $task->content .'",
											  	     ' . $task->sort_order .',
											    	"' . $task->done .'")');	

				return "Task Inserted!!!";
			}		
			else {
				return "The task type you provided is not supported. You can only use shopping or work.";
			}
		}
		else {
			return "Bad move! Try removing the task instead of deleting its content.";
		}
    }

    public function delete($uuid = null)
    {
    	$result = $this->db->query('SELECT * FROM tasks where uuid = ' . $uuid);

	    if (!$result->fetch_array(MYSQLI_ASSOC)["uuid"]) {
	    	return "Good news! The task you were trying to delete didn't even exist.";
	    }
	    else {
	    	$this->db->query('DELETE FROM tasks where uuid = ' . $uuid);
		
	   		return "Task Deleted!!!";
	    }
    }

    public function update($task = null)
    {
    	if (!$task->sort_order) {
			$task->sort_order = 1;
		}

		$result = $this->db->query('SELECT * FROM tasks where uuid = ' . $task->uuid);

	    if (!$result->fetch_array(MYSQLI_ASSOC)["uuid"]) {
	    	return "Are you a hacker or something? The task you were trying to edit doesn't exist.";
	    }
		elseif ( ($task->type == "shopping") || ($task->type == "work") ) {
			$resultUuids = $this->db->query('SELECT uuid, sort_order 
												FROM tasks 
												WHERE sort_order >= ' . $task->sort_order . '
												AND uuid != ' . $task->uuid . '
												order by sort_order asc');
			
			$alreadyExist = false;
			
			while ($row = $resultUuids->fetch_array(MYSQLI_ASSOC)) {				
				if($row["sort_order"] == $task->sort_order) {
					$alreadyExist = true;
				}

				$arrUuids[] = $row["uuid"];
			}

			if ($alreadyExist) {
				$strUuids = implode(",", $arrUuids);
				
				$this->db->query('UPDATE tasks
								  	SET sort_order = sort_order + 1				  		
								  	WHERE uuid in (' . $strUuids .')');
			}			
			
			$this->db->query('UPDATE tasks
							  	SET type = "' . $task->type .'",
							  		content = "' . $task->content .'",
							  		sort_order = "' . $task->sort_order .'",
							  		done = "' . $task->done .'"
							  	WHERE uuid =  "' . $task->uuid .'"');	

			return "Task Updated!!!";
		}
		else {
			return "The task type you provided is not supported. You can only use shopping or work.";
		}  
    }
}