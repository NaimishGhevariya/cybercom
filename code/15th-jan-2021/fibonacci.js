var n1,n2,temp,limit;

console.log("*********************** fibonacci series (coding challenge 6) ***********************")
n1=0;
n2=1;

console.log(n1);
console.log(n2);
limit = 20;


while(true){
    temp = n1 + n2;
    if(temp < limit){
        console.log(temp);
        n1 = n2;
        n2 = temp;
    }
    else break;
}