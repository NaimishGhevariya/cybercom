console.log("\n**********************challenge 3 *************************** \n");

var bills = [124,48,268];
var tips = [];
var totalBills = [];

function tipCalc(arr){
    for (i in arr){
        //calculations according to price segments.
        if(arr[i] <= 50){
            //20% for amount less then 50$.
            //using ceil function for rounding off.
            tips[i] = Math.ceil(arr[i] * 0.2);
            //calculating total bill to be paid.
            totalBills[i] = bills[i] + tips[i];
        }else if(arr[i] >50 && arr[i] < 200){
            //15% for amount greater then 50$ and less then 200$.
            tips[i] = Math.ceil(arr[i] * 0.15);
            totalBills[i] = bills[i] + tips[i];
        }
        else{
            //10% for amount greater then 10$.
            tips[i] = Math.ceil(arr[i] * 0.1);
            totalBills[i] = bills[i] + tips[i];
        }
    }
    return;
}

//calculator for total bills
tipCalc(bills);

console.log("old bills --->" + bills);
console.log("tips on bill amount --->" + tips);
console.log("total bills --->" + totalBills);