<?php
	require_once('inc/function.php');
	$contents='';
	$filename=$_GET['filename'];
	$url=$_GET['url'];
	if(file_exists($filename))
	{
		$lines=file($filename);
		$count=count($lines);
		$pagesize=10;
		$pagecount=ceil($count/$pagesize);
		if(!empty($_GET['page']))
		{
			$page=trim($_GET['page']);
		}else{
			$page=1;
		}
		$starpage=$count-($page-1)*$pagesize;
		$endpage=$count-$page*$pagesize;
		if($endpage<0)
		{
			$endpage=0;
		}
		for($i=$starpage-1;$i>=$endpage;$i--)
		{	
			if(isset($lines[$i]))
			{
				$content=$lines[$i];
				for($j=1;$j<16;$j++)
				{
					$content=str_replace(ImageEncode($j),ImageDecode(ImageEncode($j)),$content);
				}
				 $contents.="<p>".$content."</p>";
				}
			}
			if(isset($count)&&$count>10)
			{
				$refresh=$_GET['refresh'];
				$refreshvalue=$_GET['refreshvalue'];
				$url=$url."&refresh=".$refresh."&"."refreshvalue=".$refreshvalue;
				$contents.=showPage2($url,$page,$pagesize,$count,$pagecount);
			}
		}			
		echo $contents;
?> 