function getCountries()
{
    
    $.ajax({
           url: "./web-services/location/getCountryList.php",
           type:"GET",
           dataType: "json",
           async:false,
           success: countryList,
           error:function(){
                
           }
    });
}
function getmtongue()
{
    
    $.ajax({
           url: "./web-services/add-details/getMtongueList.php",
           type:"GET",
           dataType: "json",
           async:false,
           success: MtongueList,
           error:function(){
                
           }
    });
}
function getEducation()
{
    
    $.ajax({
           url: "./web-services/add-details/getEducationList.php",
           type:"GET",
           dataType: "json",
           async:false,
           success: EducationList,
           error:function(){
                
           }
    });
}
function getOccupation()
{
    
    $.ajax({
           url: "./web-services/add-details/getOccupationList.php",
           type:"GET",
           dataType: "json",
           async:false,
           success: OccupationList,
           error:function(){
                
           }
    });
}
function getHeight()
{
    
    $.ajax({
           url: "./web-services/add-details/getHeightList.php",
           type:"GET",
           dataType: "json",
           async:false,
           success: HeightList,
           error:function(){
                
           }
    });
}
function getreligion()
{
    $.ajax({
           url: "./web-services/add-details/getReligionList.php",
           type:"GET",
           dataType: "json",
           async:false,
           success: religionList,
           error:function(){
                
           }
    });
}
function getCasteList(religion_id)
{
    
    $.ajax({
           url: "./web-services/add-details/getCasteList.php?religion_id="+religion_id,
           type:"GET",
           dataType: "json",
           async:false,
           success: casteList,
           error:function(){
                
           }
    });
}
function getPartCasteList(part_religion)
{
    
    $.ajax({
           url: "./web-services/add-details/getCasteList.php?religion_id="+part_religion,
           type:"GET",
           dataType: "json",
           async:false,
           success: PartCasteList,
           error:function(){
                
           }
    });
}
function getcasteListFilter(religion_id)
{
    
    $.ajax({
           url: "./web-services/add-details/getCasteList.php?religion_id="+religion_id,
           type:"GET",
           dataType: "json",
           async:false,
           success: stateListFilter,
           error:function(){
                
           }
    });
}
/*
                State List
*/
function getStateList(country_id)
{
    
    $.ajax({
           url: "./web-services/location/getStateList.php?country_id="+country_id,
           type:"GET",
           dataType: "json",
           async:false,
           success: stateList,
           error:function(){
                
           }
    });
}


function getStateListFilter(country_id)
{
    
    $.ajax({
           url: "./web-services/location/getStateList.php?country_id="+country_id,
           type:"GET",
           dataType: "json",
           async:false,
           success: stateListFilter,
           error:function(){
                
           }
    });
}
/*
                City List
*/
function getCityList(state_id)
{
    
    $.ajax({
           url: "./web-services/location/getCityList.php?state_id="+state_id,
           type:"GET",
           dataType: "json",
           async:false,
           success: cityList,
           error:function(){
                
           }
    });
}
function getCityListFilter(state_id)
{
    
    $.ajax({
           url: "./web-services/location/getCityList.php?state_id="+state_id,
           type:"GET",
           dataType: "json",
           async:false,
           success: cityListFilter,
           error:function(){
                
           }
    });
}
function getLocalityList(city_id)
{
    
    $.ajax({
           url: "./web-services/location/getLocalityList.php?city_id="+city_id,
           type:"GET",
           dataType: "json",
           async:false,
           success: localityList,
           error:function(){
                
           }
    });
}