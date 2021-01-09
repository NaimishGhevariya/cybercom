// codding assignment 2

var team_j =[89,120,103];
var team_m =[116,94,123];

function avg(arr){
    var i;
    var sum = 0;
    for (i in arr){
        sum = sum + arr[i];
    }
    return sum / arr.length;
}

avg_j = avg(team_j)
console.log("team jhone average score: "+avg_j);

avg_m = avg(team_m)
console.log("team mike average score: "+avg_m);

if(avg_j > avg_m){
        console.log("jhone wins !!");
}
else if(avg_j == avg_m){
    console.log("match is draw.....");
}
else{
    console.log("mike wins !!");
}

var team_marry =[97,134,105];
var avg_marry = avg(team_marry);

console.log("team marry average score: "+avg_marry)

if((avg_j > avg_m) && (avg_j > avg_marry)){
    console.log("jhon is the clear winner !!");
}else if((avg_m > avg_j) && (avg_m > avg_marry)){
    console.log("mike is the winner!!");
}else if( (avg_marry > avg_j) && (avg_marry > avg_m)){
    console.log("marry is the winner!!");
}
else{
    console.log("the match is the draw.....")
}
