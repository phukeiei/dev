<style>
.btn-breadcrumb .btn:not(:last-child):after 
{
  content: " ";
  display: block;
  width: 0;
  height: 0;
  border-top: 17px solid transparent;
  border-bottom: 17px solid transparent;
  border-left: 10px solid white;
  position: absolute;
  top: 50%;
  margin-top: -17px;
  left: 100%;
  z-index: 3;
}

.btn-breadcrumb .btn:not(:last-child):before 
{
  content: " ";
  display: block;
  width: 0;
  height: 0;
  border-top: 17px solid transparent;
  border-bottom: 17px solid transparent;
  border-left: 10px solid rgb(173, 173, 173);
  position: absolute;
  top: 50%;
  margin-top: -17px;
  margin-left: 1px;
  left: 100%;
  z-index: 3;
}

/** The Spacing **/
.btn-breadcrumb .btn 
{
padding:6px 12px 6px 24px;
}
.btn-breadcrumb .btn:first-child
{
padding:6px 6px 6px 10px;
}
.btn-breadcrumb .btn:last-child
{
padding:6px 18px 6px 24px;
}

/** Default button **/
.btn-breadcrumb .btn.btn-default:not(:last-child):after 
{
border-left: 10px solid #fff;
}
.btn-breadcrumb .btn.btn-default:not(:last-child):before
{
border-left: 10px solid #ccc;
}
.btn-breadcrumb .btn.btn-default:hover:not(:last-child):after
{
border-left: 10px solid #ebebeb;
}
.btn-breadcrumb .btn.btn-default:hover:not(:last-child):before 
{
border-left: 10px solid #adadad;
}
</style>
<div class="btn-group btn-breadcrumb">
	<a href="<?php echo base_url();?>index.php/gear" class="btn btn-default"><i style="font-size:16px" class="ti ti-home"></i></a>
	<?php if($this->session->userdata('SysName')){?>
	<a href="<?php echo base_url()."index.php/".$this->session->userdata('HOME');?>" class="btn btn-default" ><?php echo $this->session->userdata('SysName');?></a>
	<?php 
		if(isset($sidebarpath)){
			$li_list="";
			foreach($sidebarpath as $path){
				$temp = $li_list;
				$li_list ='<a href="'.base_url().'index.php/UMS/UMS_Controller/setMenu/'.$path['MnID'].'" class="btn btn-default">';
				if($this->session->userdata('Language')=="EN"){
					$li_list .= $path['MnNameE'];
				}else{
					$li_list .= $path['MnNameT'];
				}
				$li_list .='</a>'.$temp;
				?>
			 <?php }
			 echo $li_list;
		?>
		<a href="<?php echo base_url()."index.php/";?>UMS/UMS_Controller/setMenu/<?php echo $this->session->userdata('MnID');?>" class="btn btn-default">
			<?php if($this->session->userdata('Language')=="EN"){
						echo $this->session->userdata('MnNameE');
					}else{
						echo $this->session->userdata('MnNameT');
					}
					?></a>
	<?php }}?>	
</div>	
<div class="container-fluid"><br>