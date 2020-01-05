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
				$result = mysqli_query($conn_news, "SELECT ID,post_title,guid,post_content FROM wp_posts WHERE post_type='post' AND post_status='publish' ORDER BY post_date DESC");
				while ($row = mysqli_fetch_assoc($result))
				{
				 $guid_num=substr($row['guid'],-3,3);
				 $post_title=$row['post_title'];
				 $link=$row['guid'];
				 $post_content=$row['post_content'];
				 $post_id=$row['ID'];
				
				$sql_thumbnail = mysqli_query($conn_news, "SELECT meta_value FROM wp_postmeta WHERE post_id = '".$post_id."' AND meta_key = '_thumbnail_id' ");
				$row_thumbnail = mysqli_fetch_assoc($sql_thumbnail);
				
				$sql_img = mysqli_query($conn_news, "SELECT guid FROM wp_posts WHERE ID = '".$row_thumbnail["meta_value"]."' ");
				$row_img = mysqli_fetch_assoc($sql_img);
				$img=$row_img['guid'];
				
				$path = $img;
				$ext = pathinfo($path, PATHINFO_EXTENSION);
				$namepic_new = '';
				if(!empty($ext)){

						$namepic_new = $post_id.'.'.$ext;
						$sql_update = "UPDATE wp_posts SET post_pic= '$namepic_new'  WHERE id=".$post_id;
						$conn_news->query($sql_update);
					if(!file_exists('upload/slim/'.$namepic_new)){
						$content = file_get_contents($img);
						$array_data[$post_id] = $namepic_new;

							//	copy($content,'uploads/news/'.$namepic_new);
					file_put_contents('upload/slim/'.$namepic_new,$content);
					}
					echo $i.'<hr>';
				}
				$i++; } 
				
				//print_r($array_data);
				
				?>

