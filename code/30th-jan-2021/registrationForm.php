<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>html challenge 8</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    $fnameErr = $lnameErr = $dateErr = $genderErr = $passErr= $repassErr = $emailErr = $remailErr =$phoneErr = $zipErr= $subErr= $checkErr = ' ';
    $show = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //$person[] = "";
        $show = true;

        //firstname
        if(isset($_POST['firstname']) && !empty($_POST['firstname'])){
            $person['firstname'] = $_POST['firstname'];
        }else{
            $show =false;
            $fnameErr ="First name is required";
        }
        //lastname
        if(isset($_POST['lastname']) && !empty($_POST['lastname'])){
            $person['lastname'] = $_POST['lastname'];
        }else{
            $show =false;
            $lnameErr ="Last name is required";
        }
        //date of birth
        if(isset($_POST['dob']) && !empty($_POST['dob'])){
            $person['dob'] = $_POST['dob'];
        }else{
            $show =false;
            $dateErr ="Date of birth is required";
        }
        //gender
        if(isset($_POST['gender']) && !empty($_POST['gender'])){
            $person['gender'] = $_POST['gender'];
        }else{
            $show =false;
            $genderErr ="Gender is required";
        }
        //email
        if(isset($_POST['email']) && !empty($_POST['email'])){
            if(isset($_POST['remail']) && !empty($_POST['remail'])){
                if($_POST['email'] == $_POST['remail']){
                    $person['email'] = $_POST['email'];
                }else{
                    $emailErr ="Email does not match, Re-enter.";
                }
            }else{
                $dateErr ="Email is required";
            }
        }else{
            $show =false;
            $emailErr ="email is required";
        }
        //password
        if(isset($_POST['password']) && !empty($_POST['password'])){
            if(isset($_POST['repassword']) && !empty($_POST['repassword'])){
                if($_POST['password'] == $_POST['repassword']){
                    $person['password'] = $_POST['password'];
                }else{
                    $passErr ="Password does not match, Re-enter.";
                }
            }else{
                $repassErr ="Password is required";
            }
        }else{
            $show =false;
            $passErr ="Password is required";
        }
        //sequrity question
        if(isset($_POST['secQuestions']) && !empty($_POST['secQuestions'])){
            //sequrity answer
            if(isset($_POST['secAnswer']) && !empty($_POST['secAnswer'])){
                $person['secQuestions'] = $_POST['secQuestions'];
                $person['secAnswer'] = $_POST['secAnswer'];
            }  
        }
        //address
        if(isset($_POST['address']) && !empty($_POST['address'])){
            $person['address'] = $_POST['address'];
        }
        //city
        if(isset($_POST['city']) && !empty($_POST['city'])){
            $person['city'] = $_POST['city'];
        }
        //state
        if(isset($_POST['states']) && !empty($_POST['states'])){
            $person['states'] = $_POST['states'];
        }
        //pincode
        if(isset($_POST['zipcode']) && !empty($_POST['zipcode'])){
            $person['zipcode'] = $_POST['zipcode'];
        }else{
            $show =false;
            $zipErr ="Pincode is required";
        }
        //phone
        if(isset($_POST['phone']) && !empty($_POST['phone'])){
            $person['phone'] = $_POST['phone'];
        }else{
            $show =false;
            $phoneErr ="Phone number is required";
        }
        //subject
        if(isset($_POST['subject']) && !empty($_POST['subject'])){
            $person['subject'] = $_POST['subject'];
        }else{
            $show =false;
            $subErr ="1 or more subject is required.";
        }
        //checked
        if(isset($_POST['checked']) && !empty($_POST['checked'])){
            if($_POST['checked'] == 'on'){
                $show = true; 
            }
            else{
                $show =false;
                $checkErr ="Agree to terms and conditions.";
            }
        }else{
            $show = false;
            $checkErr ="Agree to terms and conditions.";
        }        
    }
       
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>

    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <fieldset>
                <legend> Personal Information</legend>
                <span class="error">* Required</span> 
                <div>
                    <label for="firstname">First Name:</label>
                    <div class="subdiv">
                        <input type="text" name="firstname" id="firstname">
                        <span class="error">*
                            <?php echo $fnameErr;?>
                        </span>
                    </div>
                </div>
                <div>
                    <label for="lastname">Last Name:</label>
                    <div class="subdiv">
                        <input type="text" name="lastname" id="lastname">
                        <span class="error">*
                            <?php echo $lnameErr;?>
                        </span>
                    </div>
                </div>
                <div>
                    <label for="dob">Date of Birth:</label>
                    <div class="subdiv">
                        <input type="date" name="dob" id="dob">
                        <span class="error">* 
                            <?php echo $dateErr;?>
                        </span>
                    </div>
                </div>
                <div>
                    <label for="gender">Gender:</label>
                    <div class="subdiv">
                        <input type="radio" name="gender" id="female" value="female"><label for="female">Female</label>
                        <input type="radio" name="gender" id="male" value="male"><label for="male">Male</label>
                        <input type="radio" name="gender" id="other" value="other"><label for="other">Other</label>
                        <span class="error"> *
                            <?php echo $genderErr;?>
                        </span>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Account Information</legend>
                <div>
                    <label for="email">Email:</label>
                    <div class="subdiv">
                        <input type="email" name="email" id="email">
                        <span class="error">*
                            <?php echo $emailErr;?>
                        </span>
                        <span>(Your email address will be your username.)</span>
                        
                    </div>

                </div>
                <div>
                    <label for="remail">Re-type Email:</label>
                    <div class="subdiv">
                        <input type="email" name="remail" id="remail">
                        <span class="error">*
                            <?php echo $remailErr;?>
                        </span>
                    </div>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <div class="subdiv">
                        <input type="password" name="password" id="password" minlength="8">
                        <span class="error">*
                            <?php echo $passErr;?>
                        </span>
                        <span>(Min. 8 characters, 1 number, case-sensitive)</span>
                        
                    </div>
                </div>
                <div>
                    <label for="repassword">Re-type Password:</label>
                    <div class="subdiv">
                        <input type="password" name="repassword" id="repassword" minlength="8">
                        <span class="error">*
                            <?php echo $repassErr;?>
                        </span>
                    </div>
                </div>
                <div>
                    <label for="secQuestions">Security Questions:</label>
                    <div class="subdiv">
                        <select name="secQuestions">
                            <option id="q1" value="q1">What is your name?</option>
                            <option value="q2">What is your fathers name?</option>
                            <option value="q3">What is your mothers name?</option>
                            <option value="" selected>Choose a security question.</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="secAnswer">Security Answers:</label>
                    <div class="subdiv">
                        <input type="text" name="secAnswer" id="secAnswer">
                        <span>Not case-sensitive</span>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Contact Information</legend>
                <div>
                    <label for="address">Address:</label>
                    <div class="subdiv">
                        <input type="text" name="address" id="address">
                    </div>
                </div>
                <div>
                    <label for="city">City:</label>
                    <div class="subdiv">
                        <input type="text" name="city" id="city">
                    </div>
                </div>
                <div>
                    <label for="states">State:</label>
                    <div class="subdiv">
                        <select name="states">
                            <option value="gujarat">Gujarat</option>
                            <option value="maharashtra">Maharashtra</option>
                            <option value="goa">Goa</option>
                            <option value="rajasthan">Rajasthan</option>
                            <option value="" selected>Choose a state.</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="zipcode">Zip Code:</label>
                    <div class="subdiv">
                        <input type="number" name="zipcode" id="zipcode" minlength="6" maxlength="6">
                        <span class="error">*
                            <?php echo $zipErr;?>
                        </span>
                    </div>
                </div>
                <div>
                    <label for="phone">Phone:</label>
                    <div class="subdiv">
                        <input type="tel" name="phone" id="phone">
                        <span class="error">*
                            <?php echo $phoneErr;?>
                        </span>
                        <span>No spaces or dashes</span>
                        
                    </div>
                </div>

                <div>
                    <label for="subject">Select Subject:</label>
                    <div class="subdiv">
                        <select name="subject[]" size="4" multiple>
                            <option value="Android">Android</option>
                            <option value="Java">Java</option>
                            <option value="C#">C#</option>
                            <option value="Data Base">Data Base</option>
                            <option value="Hadoop">Hadoop</option>
                            <option value="VB script">VB script</option>
                        </select>
                        <span class="error">*
                            <?php echo $subErr;?>
                        </span>
                    </div>
                </div>

                <div>
                    <label for=""></label>
                    <div class="subdiv">
                        <input type="checkbox" name="checked" id="checked"><label for="checked"> Agree to terms and condition</label>
                        <span class="error">*
                            <?php echo $checkErr;?>
                        </span>
                    </div>
                </div>
            </fieldset>

            <input type="submit" name="submit" value="submit">
            <input type="reset" value="Reset">

        </form>
    </div>


    <?php
    //print_r($person);
        if($show){
            echo "<h1>Submitted Data:</h1>";
            echo "<table>
            <thead>
                <tr>
                    <td><b>Key</b></td>
                    <td><b>Value</b></td>
                </tr>
            </thead>";
            foreach($person as $key => $value){
                echo "<tr>";

                if($key == 'subject'){
                    echo "<td>".test_input($key)."</td>";
                    echo "<td>";
                    foreach ( $person[$key] as $innerkey => $innervalue ){
                        echo test_input($innervalue).", ";
                    }
                    echo "</td>";
                }else {
                    echo "<td>".test_input($key)."</td><td>".test_input($value)."</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    ?>

</body>

</html>