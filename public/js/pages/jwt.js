function checkJWT(){
    if($.cookie("jwtToken")==null){
        console.log('jwtToken is null... Logging out user...');
    }
    else{
        console.log('jwtToken not null, proceed');
    }
}
