<?php
$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "db_mnb";
$username = "moneyandba_root";
$password = "Admin@1234";
$dbname = "moneyandba_db";

// Create connection
$conn_news = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn_news) {
    die("Connection failed: " . mysqli_connect_error());
}
$array_data = array();
				$i=1;
				$result = mysqli_query($conn_news, "SELECT ID,post_title,guid,post_content FROM wp_posts ");
				while ($row = mysqli_fetch_assoc($result))
				{
					 $guid_num=substr($row['guid'],-3,3);
					 $post_title=$row['post_title'];
					 $link=$row['guid'];
					 $post_content=$row['post_content'];
					 $post_id=$row['ID'];
					
					if (strpos($post_content, '</a>') !== false) {
						if (strpos($post_content, '</a><br>') === false) {
							$update_content = str_replace("<a href","<br><a href",$post_content);
							$update_content = str_replace("</a>","</a><br>",$update_content);
						echo $post_id.' = '. $update_content .'<br>';
						$sql_update = "UPDATE wp_posts SET post_content= '$update_content' WHERE ID=".$post_id;
							$conn_news->query($sql_update);
						}
					}
				
					echo $i.'<hr>';
					$i++; 
				} 
				
				//print_r($array_data);
				
				?>

