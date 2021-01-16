console.log("\n**********************challenge 4 *************************** \n");

//initializing person by some default value.
var person1 = 
{
    firstName:"John", 
    lastName:"Doe", 
    mass:50, 
    height:1.5,
    bmi
};
//initializing person by using object() and with some default value.
var person2 = new Object();
person2 ={
    firstName:"Mark", 
    lastName:"Matters", 
    mass:40, 
    height:1.5,
    bmi
};

//calulation function for bmi
function bmi(obj){
    obj.bmi = obj.mass / (obj.height * obj.height);
    return obj;
}

//describing data of objects on console.
console.log(person1.firstName+" "+person1.lastName+"'s data----->");
console.log("\tmass: " + person1.mass + "kg");
console.log("\theight: " + person1.height + "m");
console.log("\tbmi: " + bmi(person1).bmi);
console.log("\n");

console.log(person2.firstName+" "+person2.lastName+"'s data----->");
console.log("\tmass: " + person2.mass + "kg");
console.log("\theight: " + person2.height + "m");
console.log("\tbmi: " + bmi(person2).bmi);
console.log("\n");

//conditional checks for bmi 
if(person1.bmi > person2.bmi){
    info = true;
    console.log(person1.firstName+" "+person1.lastName+" wins !!");
}
else if(person1.bmi < person2.bmi){
    console.log(person2.firstName+" "+person2.lastName+" wins !!");
}
else{
    console.log("both have the same bmi.");
}