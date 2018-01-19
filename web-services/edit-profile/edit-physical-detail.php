<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';	
   

	$s_id =$_GET['sid'];
    $DatabaseCo = new DatabaseConn(); 
    $SQL_STATEMENT = "select username,height,weight,b_group,complexion,bodytype,diet,smoke,drink from register_view where matri_id='$s_id'";
    $DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
    $DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult);
	
	
	?>
<link rel="stylesheet" href="css/validate.css">
<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="js/validetta.js" type="text/javascript"></script>

       
<div class="modal-dialog">
  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Physical Information of <?php echo $DatabaseCo->dbRow->username; ?></h4>
      </div>
      
      <form name="reg_form" id="reg_form" class="form-horizontal" action="" method="post">
       
             
                          <div class="form-group" style="margin-top:10px;">
                            <label for="inputEmail3" class="col-sm-4 control-label">Height &nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-4">
                               <select class="form-control" name="txtHeight" data-validetta="required">
    <option value="<?php echo $DatabaseCo->dbRow->height; ?>"><?php echo $DatabaseCo->dbRow->height; ?></option>                      <option value="Below 4ft 6in - 137cm">Below 4ft 6in - 137cm</option>
                      <option value="4ft 6in - 137cm">4ft 6in - 137cm</option>
                      <option value="4ft 7in - 139cm">4ft 7in - 139cm</option>
                      <option value="4ft 8in - 142cm">4ft 8in - 142cm</option>
                      <option value="4ft 9in - 144cm">4ft 9in - 144cm</option>
                      <option value="4ft 10in - 147cm">4ft 10in - 147cm</option>
                      <option value="4ft 11in - 149cm">4ft 11in - 149cm</option>
                      <option value="5ft - 152cm">5ft - 152cm</option>
                      <option value="5ft 1in - 154cm">5ft 1in - 154cm</option>
                      <option value="5ft 2in - 157cm">5ft 2in - 157cm</option>
                      <option value="5ft 3in - 160cm">5ft 3in - 160cm</option>
                      <option value="5ft 4in - 162cm">5ft 4in - 162cm</option>
                      <option value="5ft 5in - 165cm">5ft 5in - 165cm</option>
                      <option value="5ft 6in - 167cm">5ft 6in - 167cm</option>
                      <option value="5ft 7in - 170cm">5ft 7in - 170cm</option>
                      <option value="5ft 8in - 172cm">5ft 8in - 172cm</option>
                      <option value="5ft 9in - 175cm">5ft 9in - 175cm</option>
                      <option value="5ft 10in - 177cm">5ft 10in - 177cm</option>
                      <option value="5ft 11in - 180cm">5ft 11in - 180cm</option>
                      <option value="6ft - 182cm">6ft - 182cm</option>
                      <option value="6ft 1in - 185cm">6ft 1in - 185cm</option>
                      <option value="6ft 2in - 187cm">6ft 2in - 187cm</option>
                      <option value="6ft 3in - 190cm">6ft 3in - 190cm</option>
                      <option value="6ft 4in - 193cm">6ft 4in - 193cm</option>
                      <option value="6ft 5in - 195cm">6ft 5in - 195cm</option>
                      <option value="6ft 6in - 198cm">6ft 6in - 198cm</option>
                      <option value="6ft 7in - 200cm">6ft 7in - 200cm</option>
                      <option value="6ft 8in - 203cm">6ft 8in - 203cm</option>
                      <option value="6ft 9in - 205cm">6ft 9in - 205cm</option>
                      <option value="6ft 10in - 208cm">6ft 10in - 208cm</option>
                      <option value="6ft 11in - 210cm">6ft 11in - 210cm</option>
                      <option value="7ft - 213cm">7ft - 213cm</option>
                      <option value="Above 7ft - 213cm">Above 7ft - 213cm</option>
                                      </select>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Weight &nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-2">
                             <select class="form-control" name="txtWeight">
     <option value="<?php echo $DatabaseCo->dbRow->weight; ?>"><?php echo $DatabaseCo->dbRow->weight; ?> Kg</option>         		    <option value="40">40 Kg</option>
                                            <option value="41">41 Kg</option>
                                            <option value="42">42 Kg</option>
                                            <option value="43">43 Kg</option>
                                            <option value="44">44 Kg</option>
                                            <option value="45">45 Kg</option>
                                            <option value="46">46 Kg</option>
                                            <option value="47">47 Kg</option>
                                            <option value="48">48 Kg</option>
                                            <option value="49">49 Kg</option>
                                            <option value="50">50 Kg</option>
                                            <option value="51">51 Kg</option>
                                            <option value="52">52 Kg</option>
                                            <option value="53">53 Kg</option>
                                            <option value="54">54 Kg</option>
                                            <option value="55">55 Kg</option>
                                            <option value="56">56 Kg</option>
                                            <option value="57">57 Kg</option>
                                            <option value="58">58 Kg</option>
                                            <option value="59">59 Kg</option>
                                            <option value="60">60 Kg</option>
                                            <option value="61">61 Kg</option>
                                            <option value="62">62 Kg</option>
                                            <option value="63">63 Kg</option>
                                            <option value="64">64 Kg</option>
                                            <option value="65">65 Kg</option>
                                            <option value="66">66 Kg</option>
                                            <option value="67">67 Kg</option>
                                            <option value="68">68 Kg</option>
                                            <option value="69">69 Kg</option>
                                            <option value="70">70 Kg</option>
                                            <option value="71">71 Kg</option>
                                            <option value="72">72 Kg</option>
                                            <option value="73">73 Kg</option>
                                            <option value="74">74 Kg</option>
                                            <option value="75">75 Kg</option>
                                            <option value="76">76 Kg</option>
                                            <option value="77">77 Kg</option>
                                            <option value="78">78 Kg</option>
                                            <option value="79">79 Kg</option>
                                            <option value="80">80 Kg</option>
                                            <option value="81">81 Kg</option>
                                            <option value="82">82 Kg</option>
                                            <option value="83">83 Kg</option>
                                            <option value="84">84 Kg</option>
                                            <option value="85">85 Kg</option>
                                            <option value="86">86 Kg</option>
                                            <option value="87">87 Kg</option>
                                            <option value="88">88 Kg</option>
                                            <option value="89">89 Kg</option>
                                            <option value="90">90 Kg</option>
                                            <option value="91">91 Kg</option>
                                            <option value="92">92 Kg</option>
                                            <option value="93">93 Kg</option>
                                            <option value="94">94 Kg</option>
                                            <option value="95">95 Kg</option>
                                            <option value="96">96 Kg</option>
                                            <option value="97">97 Kg</option>
                                            <option value="98">98 Kg</option>
                                            <option value="99">99 Kg</option>
                                            <option value="100">100 Kg</option>
                                            <option value="101">101 Kg</option>
                                            <option value="102">102 Kg</option>
                                            <option value="103">103 Kg</option>
                                            <option value="104">104 Kg</option>
                                            <option value="105">105 Kg</option>
                                            <option value="106">106 Kg</option>
                                            <option value="107">107 Kg</option>
                                            <option value="108">108 Kg</option>
                                            <option value="109">109 Kg</option>
                                            <option value="110">110 Kg</option>
                                            <option value="111">111 Kg</option>
                                            <option value="112">112 Kg</option>
                                            <option value="113">113 Kg</option>
                                            <option value="114">114 Kg</option>
                                            <option value="115">115 Kg</option>
                                            <option value="116">116 Kg</option>
                                            <option value="117">117 Kg</option>
                                            <option value="118">118 Kg</option>
                                            <option value="119">119 Kg</option>
                                            <option value="120">120 Kg</option>
                                            <option value="121">121 Kg</option>
                                            <option value="122">122 Kg</option>
                                            <option value="123">123 Kg</option>
                                            <option value="124">124 Kg</option>
                                            <option value="125">125 Kg</option>
                                            <option value="126">126 Kg</option>
                                            <option value="127">127 Kg</option>
                                            <option value="128">128 Kg</option>
                                            <option value="129">129 Kg</option>
                                            <option value="130">130 Kg</option>
                                            <option value="131">131 Kg</option>
                                            <option value="132">132 Kg</option>
                                            <option value="133">133 Kg</option>
                                            <option value="134">134 Kg</option>
                                            <option value="135">135 Kg</option>
                                            <option value="136">136 Kg</option>
                                            <option value="137">137 Kg</option>
                                            <option value="138">138 Kg</option>
                                            <option value="139">139 Kg</option>
                                            <option value="140">140 Kg</option>
                              </select>
                            </div>
                          </div>
                                      
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Complexion&nbsp;</label>
                            <div class="col-sm-4">
                              
              <select class="form-control" name="txtComplexion">
                                        
  <option value="<?php echo $DatabaseCo->dbRow->complexion; ?>"><?php echo $DatabaseCo->dbRow->complexion; ?></option>                      <option value="">Please select..</option>
                      <option value="Very Fair">Very Fair</option>
                      <option value="Fair">Fair</option>
                      <option value="Wheatish">Wheatish</option>
                      <option value="Wheatish Brown">Wheatish Brown</option>
                      <option value="Dark">Dark</option>
                                      </select>
                            </div>
                           
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Body type &nbsp;&nbsp;</label>
                            <div class="col-sm-6">
                           <input name="txtBody" type="radio" value="Slim" <?php if($DatabaseCo->dbRow->bodytype=="Slim" ){?> checked="checked" <?php }?>>
                                    Slim &nbsp;
                                    <input name="txtBody" type="radio" value="Average" <?php if($DatabaseCo->dbRow->bodytype=="Average" ){?> checked="checked" <?php }?>>
                                    Average &nbsp;
                                    <input name="txtBody" type="radio" value="Athletic" <?php if($DatabaseCo->dbRow->bodytype=="Athletic" ){?> checked="checked" <?php }?>>
                                    Athletic &nbsp;
                                    <input name="txtBody" type="radio" value="Heavy" <?php if($DatabaseCo->dbRow->bodytype=="Heavy" ){?> checked="checked" <?php }?>>
                                    Heavy 
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Blood Group  &nbsp;&nbsp;</label>
                            <div class="col-sm-4">
                            <select name="txtBlood" id="txtBlood" class="form-control">
  <option value="<?php echo $DatabaseCo->dbRow->b_group; ?>"><?php echo $DatabaseCo->dbRow->b_group; ?></option>    
                                        <option value="">Select</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                      </select>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Diet &nbsp;&nbsp;</label>
                            <div class="col-sm-4">
                           <select name="txtDiet" id="txtDiet" class="form-control">
<option value="<?php echo $DatabaseCo->dbRow->diet; ?>"><?php echo $DatabaseCo->dbRow->diet; ?></option>                                        <option value="">Select</option>
                                        <option value="Veg">Veg</option>
                                        <option value="Eggetarian">Eggetarian</option>
                                        <option value="Occasionally Non-Veg">Occasionally Non-Veg</option>
                                        <option value="Non-Veg">Non-Veg</option>
                                      </select>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Smoke &nbsp;&nbsp;</label>
                            <div class="col-sm-4">
                             <input name="smoke" type="radio" value="Yes" <?php if($DatabaseCo->dbRow->smoke=="Yes" ){?> checked="checked" <?php }?>>
                                    Yes &nbsp;
                                    <input name="smoke" type="radio" value="No" <?php if($DatabaseCo->dbRow->smoke=="No" ){?> checked="checked" <?php }?>>
                                    No &nbsp;
                                    <input name="smoke" type="radio" value="Occassionally" <?php if($DatabaseCo->dbRow->smoke=="Occassionally" ){?> checked="checked" <?php }?>>
                                    Occassionally &nbsp;
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Drink &nbsp;&nbsp;</label>
                            <div class="col-sm-4">
                            <input name="drink" type="radio" value="Yes" <?php if($DatabaseCo->dbRow->drink=="Yes" ){?> checked="checked" <?php }?>>
                                    Yes &nbsp;
                                    <input name="drink" type="radio" value="No" <?php if($DatabaseCo->dbRow->drink=="No" ){?> checked="checked" <?php }?>>
                                    No &nbsp;
                                    <input name="drink" type="radio" value="Occassionally" <?php if($DatabaseCo->dbRow->drink=="Occassionally" ){?> checked="checked" <?php }?>>
                                    Occassionally &nbsp;
                            </div>
                          </div>
                          
                          
                          
                          
                          
                          
                          
                          <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-10">
                    <input type="submit" name="edit-physical-detail" value="submit" class="btn btn-success">
                            </div>
                          </div>
                        </form>
      
    </div>
  </div>
<script type="text/javascript">
    $(function(){
    	$('#reg_form').validetta({
    		errorClose : false,
			custom : {
    			regname : {
    				pattern : /^[\+][0-9]+?$|^[0-9]+?$/,
    				errorMessage : 'Custom Reg Error Message !'
    			},
                // you can add more
    			example : { 
    				pattern : /^[\+][0-9]+?$|^[0-9]+?$/,
    				errorMessage : 'Lan mal !'
    			}
    		},
            realTime : true
    	});	 
	
		
    });
    </script>