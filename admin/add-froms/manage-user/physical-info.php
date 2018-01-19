   <?php

	include_once '../../databaseConn.php';

	include_once '../../lib/requestHandler.php';

	$DatabaseCo = new DatabaseConn();

	$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;

	$user_id = isset($_GET['index_id']) ? $_GET['index_id'] :"" ;

    $save_btn_text = "Save";

    $height = "";
	$weight = "";
	$complexion = "";
	$b_group = "";
    $body_type = "";
	$diet = "";
	$smoke = "";
	$drink = "";

    

	$ACTION_MODE = "ADD";

	if(!empty($user_id)){

	  $getRowCountSQL = "SELECT count(index_id) as 'TOTAL_USER' FROM   register where index_id=".$user_id;


		$rowCount = getRowCount($getRowCountSQL,$DatabaseCo);

		if($rowCount==1)

			$ACTION = "UPDATE";

	}	

  

  if($ACTION == "UPDATE")

  {

	 $SQL_STATEMENT2 = "SELECT * FROM register_view where index_id=".$user_id;

	  $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);

					  

	  while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))

	  {

                    $height = $DatabaseCo->dbRow->height;
					$weight = $DatabaseCo->dbRow->weight;
					$complexion =$DatabaseCo->dbRow->complexion;
					$b_group = $DatabaseCo->dbRow->b_group;
                    $body_type = $DatabaseCo->dbRow->bodytype;
					$diet = $DatabaseCo->dbRow->diet;
					$smoke = $DatabaseCo->dbRow->smoke;
					$drink = $DatabaseCo->dbRow->drink;

	  }

	  $ACTION_MODE = "UPDATE";

	  $save_btn_text = "Update";

  }
?>
<span class="field_marked">All Fields are required.</span>

<div class='error-msg' id='validationSummary'></div>

  <form action="./web-services/edit-user/physical-info.php?action=<?php echo $ACTION_MODE;?>&user_id=<?php echo $user_id;?>"  method="post"  class="form-data" id="add-form">



		<p class="cf">

	      <label><font id="star">*</font> 1. Height :</label>

	      <select class="comboBox" name="height">

                   <option value="<?php echo $height;?>"><?php echo $height;?></option>
		
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


	      

	      </p>		
          
          
          <p class="cf">

	      <label><font id="star">*</font> 2. Weight :</label>

	      <select class="comboBox" name="weight">
<option value="<?php echo $weight;?>"><?php echo $weight;?> Kg</option>
                  							<option value="40">40 Kg</option>
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


	      

	      </p>
          
          <p class="cf">

	      <label>3. Complexion  :</label>

	      <select class="comboBox" name="complexion">
          <option value="<?php echo $complexion;?>"><?php echo $complexion;?></option>
 				<option value="">Please select..</option>
                      <option value="Very Fair">Very Fair</option>
                      <option value="Fair">Fair</option>
                      <option value="Wheatish">Wheatish</option>
                      <option value="Wheatish Brown">Wheatish Brown</option>
                      <option value="Dark">Dark</option>

                </select>      

	      </p>
          
          <p class="cf">

	      <label>4. Blood Group  :</label>

	      						<select class="comboBox" name="blood_group">
                      <option value="<?php echo $b_group;?>"><?php echo $b_group;?></option>
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


	      

	      </p>



		<p class="cf">

	      <label> 5. Body Type:</label>

	     <input type="radio"  value="Slim" name="body_type" <?php if($body_type=='Slim') {?> checked <?php } ?>  />

            <span class="radio-btn-text">Slim</span>

            <input type="radio"  value="Athletic" name="body_type" <?php if($body_type=='Athletic') {?> checked <?php } ?>/>

            <span class="radio-btn-text">Athletic</span>
            
            <input type="radio"  value="Average" name="body_type" <?php if($body_type=='Average') {?> checked <?php } ?>/>

            <span class="radio-btn-text">Average</span>
            
            <input type="radio"  value="Heavy" name="body_type" <?php if($body_type=='Heavy') {?> checked <?php } ?>/>

            <span class="radio-btn-text">Heavy</span>

	      

	      </p>
          
          <p class="cf">

	      <label> 6. Diet:</label>

	     <select class="comboBox" name="diet">

                 <option value="<?php echo $diet; ?>"><?php echo $diet; ?></option>   
                 						<option value="">Select</option>
                                        <option value="Veg">Veg</option>
                                        <option value="Eggetarian">Eggetarian</option>
                                        <option value="Occasionally Non-Veg">Occasionally Non-Veg</option>
                                        <option value="Non-Veg">Non-Veg</option>
            

                </select>
	      

	      </p>
          
          <p class="cf">

	      <label> 7. Smoke:</label>

	     <input type="radio"  value="No" name="smoke" <?php if($smoke=='No') {?> checked <?php } ?>/>

            <span class="radio-btn-text">No</span>

            <input type="radio"  value="Yes" name="smoke" <?php if($smoke=='Yes') {?> checked <?php } ?>/>

            <span class="radio-btn-text">Yes</span>
            
            <input type="radio"  value="Occasionally" name="smoke" <?php if($smoke=='Occasionally') {?> checked <?php } ?>/>

            <span class="radio-btn-text">Occasionally</span>

	      

	      </p>
          
          <p class="cf">

	      <label> 8. Drink:</label>

	      <input type="radio"  value="No" name="drink" <?php if($drink=='No') {?> checked <?php } ?>/>

            <span class="radio-btn-text">No</span>

            <input type="radio"  value="Yes" name="drink" <?php if($drink=='Yes') {?> checked <?php } ?>/>

            <span class="radio-btn-text">Yes</span>
            
            <input type="radio"  value="Occasionally" name="drink" <?php if($drink=='Occasionally') {?> checked <?php } ?>/>

            <span class="radio-btn-text">Occasionally</span>
	      

	      </p>

	    											

	  <input type="hidden" name="user_id" value="<?php echo $user_id;?>" />

	  

	

	  <input type="hidden" id="action" value="<?php echo $ACTION_MODE;?>"/>

	  

          <p class="submit-btn cf">

            <input type="submit"  class="save-btn" value="<?php echo $save_btn_text;?>" title="Save" id="add_basic_save"/>

            <input type="reset" class="save-btn" value="Cancel" title="Cancel"/>

          </p>

        </form>

	<script type="text/javascript" src="./js/util/location-validation.js"></script>

	<script type="text/javascript" >

		registerForm();

	</script>