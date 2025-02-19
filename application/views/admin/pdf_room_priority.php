    <h2>Room Priorities - <?php $employeeINFO = admin_helper::get_user_name($employee);
        if($employeeINFO[0]->manager_inspector != ''){echo $employeeINFO[0]->username.' ('.ucfirst($employeeINFO[0]->manager_inspector).')';}else{echo $employeeINFO[0]->username;}?>
    </h2>
    <table style="width:600px; border: 1px solid black; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid black;">Date</th>
                <th style="border: 1px solid black;">Housekeeper Name</th>
                <th style="border: 1px solid black;">Room#</th>
                <th style="border: 1px solid black;">Priority</th>
            </tr>
        </thead>
        <tbody>
        	<?php
				$curr_date = gmdate('Y-m-d', strtotime($this->session->userdata['logged_in']['tz'].' hours'));
				$employeeRooms = admin_helper::get_assigned_rooms_by_id($this->session->userdata['logged_in']['firm_id'], $employee, $curr_date);
				if(is_array($employeeRooms)){
					if(count($employeeRooms) > 0){
						foreach($employeeRooms as $rooms_list){?>
                            <tr>
                                <td style="border: 1px solid black; text-align:center;"><?php echo $curr_date;?></td>
                                <td style="border: 1px solid black; text-align:center;"><?php if($employeeINFO[0]->manager_inspector != ''){echo $employeeINFO[0]->username.' ('.ucfirst($employeeINFO[0]->manager_inspector).')';}else{echo $employeeINFO[0]->username;}?></td>
                                <td style="border: 1px solid black; text-align:center;"><?php echo $rooms_list->assign_rooms;?></td>
                                <td style="border: 1px solid black; text-align:center;"><?php echo $rooms_list->priority;?></td>
                            </tr>
				<?php }}else{?>
                	<tr>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                    </tr>
				<?php }}?>            
        </tbody>
    </table>