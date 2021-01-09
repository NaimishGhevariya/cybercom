//    codding assignment 1

function bmi(mass, height){
    return mass / (height * height);
}

var mrk_mass = 22;
var mrk_hgt = 1.2;
var jhn_mass = 1.6;
var jhn_hgt = 40;

var mrk_bmi = bmi(mrk_mass,mrk_hgt);
console.log("mark data----->");
console.log("mass: " + mrk_mass + "kg");
console.log("height: " + mrk_hgt + "m");
console.log("bmi: " + mrk_bmi);

var jhn_bmi = bmi(jhn_mass,jhn_hgt);
console.log("jhon data----->");
console.log("mass: " + jhn_mass + "kg");
console.log("height: " + jhn_hgt + "m");
console.log("bmi: " + jhn_bmi);

var info;

if(mrk_bmi > jhn_bmi){
    info = true;
    console.log("Is mark's bmi higher than jhon's ? " + info);
}