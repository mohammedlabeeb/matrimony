<?php      
       
        $DatabaseCo = new DatabaseConn();
        $SQL_STATEMENT =  "SELECT * FROM register_view WHERE matri_id='$mid'";
        $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
        $DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult);     

{
    //photo 
    $photo1 = $DatabaseCo->dbRow->photo1;
    $photo2 = $DatabaseCo->dbRow->photo2;
    $photo3 = $DatabaseCo->dbRow->photo3;
    $photo4 = $DatabaseCo->dbRow->photo4;
    $photo5 = $DatabaseCo->dbRow->photo5;
    $photo6 = $DatabaseCo->dbRow->photo6;
    
    // Basic Details
    $fname = $DatabaseCo->dbRow->firstname;
    $lname = $DatabaseCo->dbRow->lastname;
    $mstatus = $DatabaseCo->dbRow->m_status;
    $mtongue = $DatabaseCo->dbRow->m_tongue;
    $bplace = $DatabaseCo->dbRow->birthplace;
    $btime = $DatabaseCo->dbRow->birthtime;
    $bdate = $DatabaseCo->dbRow->birthdate;
    $profileby = $DatabaseCo->dbRow->profileby;
    $reference = $DatabaseCo->dbRow->reference;
    
    //Hobby and Profile Text
    $profile_text = $DatabaseCo->dbRow->profile_text;
    $hobby = $DatabaseCo->dbRow->hobby;
    
    //Education Details 
    $edu = $DatabaseCo->dbRow->edu_detail;
    $income = $DatabaseCo->dbRow->income;
    $occ = $DatabaseCo->dbRow->occupation;
    $emp = $DatabaseCo->dbRow->emp_in;
    
    //Contact Details
    $address = $DatabaseCo->dbRow->address;
    $state = $DatabaseCo->dbRow->state_id;
    $city = $DatabaseCo->dbRow->city;
    $country = $DatabaseCo->dbRow->country_id;
    $mobile = $DatabaseCo->dbRow->mobile;
    $phone = $DatabaseCo->dbRow->phone;
    $timetocall = $DatabaseCo->dbRow->time_to_call;
    $res_stat = $DatabaseCo->dbRow->edu_detail; 
    
    //Video 
    $video = $DatabaseCo->dbRow->video; 
    
    //Social Attributes
    $religion = $DatabaseCo->dbRow->religion;
    $caste = $DatabaseCo->dbRow->caste;
    $subcaste = $DatabaseCo->dbRow->subcaste;
    $horoscope = $DatabaseCo->dbRow->horoscope;
    $manglik = $DatabaseCo->dbRow->manglik;
    $godhra = $DatabaseCo->dbRow->gothra;
    $star = $DatabaseCo->dbRow->star;
    $moonsing = $DatabaseCo->dbRow->moonsign;
    
    //Partner Preference
    $part_exp = $DatabaseCo->dbRow->part_expect;
    $looking_for = $DatabaseCo->dbRow->looking_for;
    $part_frm_age = $DatabaseCo->dbRow->part_frm_age;
    $part_to_age = $DatabaseCo->dbRow->part_to_age;
    $part_religion = $DatabaseCo->dbRow->moonsign;
    $part_caste = $DatabaseCo->dbRow->moonsign;
    $part_height = $DatabaseCo->dbRow->moonsign;
    $part_height_to = $DatabaseCo->dbRow->moonsign;
    $part_complexation = $DatabaseCo->dbRow->moonsign;
    $part_edu = $DatabaseCo->dbRow->moonsign;
    $part_country_living = $DatabaseCo->dbRow->moonsign;
    $part_resi_status = $DatabaseCo->dbRow->moonsign;
    $part_mtongue = $DatabaseCo->dbRow->moonsign;
    
    //Family Details
    $family_details = $DatabaseCo->dbRow->family_details;
    $father_name = $DatabaseCo->dbRow->father_name;
    $mother_name = $DatabaseCo->dbRow->mother_name;
    $father_occupation = $DatabaseCo->dbRow->father_occupation;
    $mother_occupation = $DatabaseCo->dbRow->mother_occupation;
    $no_of_sisters = $DatabaseCo->dbRow->no_of_sisters;
    $family_origion = $DatabaseCo->dbRow->family_origin;
    $family_type = $DatabaseCo->dbRow->family_type;
    $family_status = $DatabaseCo->dbRow->family_status;
    $no_of_brothers = $DatabaseCo->dbRow->no_of_brothers;
    $no_marri_brothers = $DatabaseCo->dbRow->no_marri_brother;
    $no_marri_sisters = $DatabaseCo->dbRow->no_marri_sister;
    
    //Physical Attribute
    $height = $DatabaseCo->dbRow->height;
    $weight = $DatabaseCo->dbRow->weight;
    $b_group = $DatabaseCo->dbRow->b_group;
    $complexation = $DatabaseCo->dbRow->complexion;
    $bodytype = $DatabaseCo->dbRow->bodytype;
    
    // Email Varification
    $cpass_status = $DatabaseCo->dbRow->cpass_status;
    // Mobile Varification
    $part_mtongue = $DatabaseCo->dbRow->moonsign;
}
        // Photo 1 as 5% value
         if($photo1 != '')   {    $photo1 = '5';   }else{    $photo1 = '0';       }
         if($photo2 != '' && $photo3 != '' && $photo4 != '' && $photo5 != '' && $photo6 != '')   {    $photo2 = '5';   }else{    $photo2 = '0';       }
        // Basic Details as 8% value
         if($fname != '' AND $lname != '')    {     $fname = '1';     }else{     $fname = '0';        }        
         if($mstatus != '')   {    $lname = '1';    }else{    $lname = '0';    }        
         if($mtongue != '')   {    $mtongue = '1';    }else{    $mtongue = '0';    }
         if($bplace != '')   {    $bplace = '1';    }else{    $bplace = '0';    }
         if($btime != '')   {    $btime = '1';    }else{    $btime = '0';    }
         if($bdate != '')   {    $bdate = '1';    }else{    $bdate = '0';    }
         if($profileby != '')   {    $profileby = '1';    }else{    $profileby = '0';    }
         if($reference != '')   {    $reference = '1';    }else{    $reference = '0';    }
         // Hobby and Profile Text as 5% valus
         if($profile_text != '')   {    $profile_text = '3';    }else{    $profile_text = '0';    }
         if($hobby != '')   {    $hobby = '2';    }else{    $hobby = '0';    }         
         //Education Details as 8% values
         if($edu != '')   {    $edu = '2';    }else{    $edu = '0';    }
         if($income != '')   {    $income = '2';    }else{    $income = '0';    }
         if($occ != '')   {    $occ = '2';    }else{    $occ = '0';    }
         if($emp != '')   {    $emp = '2';    }else{    $emp = '0';    }
         //Contact Details as 20% value
         if($address != '')   {    $address = '6';    }else{    $address = '0';    }
         if($state != '')   {    $state = '2';    }else{    $state = '0';    }
         if($city != '')   {    $city = '2';    }else{    $city = '0';    }
         if($country != '')   {    $country = '2';    }else{    $country = '0';    }
         if($mobile != '')   {    $mobile = '2';    }else{    $mobile = '0';    }
         if($phone != '')   {    $phone = '2';    }else{    $phone = '0';    }
         if($timetocall != '')   {    $timetocall = '2';    }else{    $timetocall = '0';    }
         if($res_stat != '')   {    $res_stat = '2';    }else{    $res_stat = '0';    }
         //Video Details as 5%
         if($video != '')   {    $video = '3';    }else{    $video = '0';    }
         //Social Religion Atributes as 10% value
         if($religion != '')   {    $religion = '2';    }else{    $religion = '0';    }
         if($caste != '')   {    $caste = '2';    }else{    $caste = '0';    }
         if($subcaste != '')   {    $subcaste = '1';    }else{    $subcaste = '0';    }
         if($horoscope != '')   {    $horoscope = '1';    }else{    $horoscope = '0';    }
         if($manglik != '')   {    $manglik = '1';    }else{    $manglik = '0';    }
         if($godhra != '')   {    $godhra = '1';    }else{    $godhra = '0';    }
         if($star != '')   {    $star = '1';    }else{    $star = '0';    }
         if($moonsing != '')   {    $moonsing = '1';    }else{    $moonsing = '0';    }
         //Partner Preference as 15% value
         if($part_exp != '')   {    $part_exp = '1';    }else{    $part_exp = '0';    }
         if($looking_for != '')   {    $looking_for = '1';    }else{    $looking_for = '0';    }
         if($part_frm_age != '' && $part_to_age!='')   {    $part_age = '1';    }else{    $part_age = '0';    }
         if($part_religion != '')   {    $part_religion = '2';    }else{    $part_religion = '0';    }
         if($part_caste != '')   {    $part_caste = '2';    }else{    $part_caste = '0';    }
         if($part_height != '' && $part_height_to!='')   {    $part_height = '1';    }else{    $part_height = '0';    }
         if($part_complexation != '')   {    $part_complexation = '1';    }else{    $part_complexation = '0';    }
         if($part_edu != '')   {    $part_edu = '1';    }else{    $part_edu = '0';    }
         if($part_country_living != '')   {    $part_country_living = '2';    }else{    $part_country_living = '0';    }
         if($part_resi_status != '')   {    $part_resi_status = '1';    }else{    $part_resi_status = '0';    }
         if($part_mtongue != '')   {    $part_mtongue = '2';    }else{    $part_mtongue = '0';    }
         // Family Details as 6% value
         if($family_details != '')   {    $family_details = '0.5';    }else{    $family_details = '0';    }
         if($father_name != '')   {    $father_name = '0.5';    }else{    $father_name = '0';    }
         if($mother_name != '')   {    $mother_name = '0.5';    }else{    $mother_name = '0';    }
         if($father_occupation != '')   {    $father_occupation = '0.5';    }else{    $father_occupation = '0';    }
         if($mother_occupation != '')   {    $mother_occupation = '0.5';    }else{    $mother_occupation = '0';    }
         if($no_of_sisters != '')   {    $no_of_sisters = '0.5';    }else{    $no_of_sisters = '0';    }
         if($family_origion != '')   {    $family_origion = '0.5';    }else{    $family_origion = '0';    }
         if($family_type != '')   {    $family_type = '0.5';    }else{    $family_type = '0';    }
         if($family_status != '')   {    $family_status = '0.5';    }else{    $family_status = '0';    }
         if($no_of_brothers != '')   {    $no_of_brothers = '0.5';    }else{    $no_of_brothers = '0';    }
         if($no_marri_brothers != '')   {    $no_marri_brothers = '0.5';    }else{    $no_marri_brothers = '0';    }
         if($no_marri_sisters != '')   {    $no_marri_sisters = '0.5';    }else{    $no_marri_sisters = '0';    }
         
         //Physical attributes as 5% value
         if($height != '')   {    $height = '1';    }else{    $height = '0';    }
         if($weight != '')   {    $weight = '1';    }else{    $weight = '0';    }
         if($b_group!= '')   {    $b_group = '1';    }else{    $b_group = '0';    }
         if($complexation != '')   {    $complexation = '1';    }else{    $complexation = '0';    }
         if($bodytype != '')   {    $bodytype = '1';    }else{    $bodytype = '0';    }
         
         // Email VArification as 5% value
         if($cpass_status != '')   {    $cpass_status = '5';    }else{    $cpass_status = '0';    }
         
         
        $hasCompletedPhoto = ($photo1+$photo2);
        $hasCompletedVideo = ($video+$cpass_status);
        $hasCompletedBasic = ($fname+$lname+$mstatus+$mtongue+$bdate+$btime+$bplace+$profileby+$reference+$hobby+$profile_text);
        $hasCompletedEdu = ($emp+$occ+$income+$edu);
        $hasCompletedCont = ($address+$state+$city+$country+$mobile+$phone+$timetocall+$res_stat);
        $hasCompletedSocial = ($religion+$caste+$subcaste+$horoscope+$manglik+$godhra+$star+$moonsing+$part_edu);
        $hasCompletedPart = ($part_exp+$part_age+$looking_for+$part_religion+$part_caste+$part_height+$part_complexation+$part_country_living+$part_resi_status+$part_mtongue);
        $hasCompletedFamily = ($family_details+$father_name+$mother_name+$father_occupation+$mother_occupation+$no_of_sisters+$family_origion+$family_type+$family_status+$no_of_brothers+$no_marri_brothers+$no_marri_sisters);
        $hasCompletedPhysical = ($height+$weight+$b_group+$complexation+$bodytype);
        
        $maximumPoints  = 100;
        $percentage = ($hasCompletedPhoto+$hasCompletedBasic+$hasCompletedEdu+$hasCompletedCont+$hasCompletedVideo+$hasCompletedSocial+$hasCompletedPart+$hasCompletedFamily+$hasCompletedPhysical)*$maximumPoints/100;
        return $percentage;
// In the end print necessary code to the end of the html.
?>