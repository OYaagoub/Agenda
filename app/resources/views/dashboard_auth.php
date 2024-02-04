<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link rel="stylesheet" href="app/resources/css/style.css">
</head>

<body>
    <div id="log">
        <div id="auth" >

            <span style="display:flex;align-items:center;padding:3px;flex-direction:column">
                                <img style="width:60px;" src="app/resources/icon/user.png" alt="">
                                <p style="font-size:16px" id="username"></p>
                                </span>
                                <a href="#" style="display:flex;text-align:center;justify-content:center;align-items: center;" id="logout">logout</a>
                                
        </div>
        <div id="guset">
                        <a href="#" id="login">login</a>
                        <a href="#" id="register">register</a>
        </div>

    </div>
    <?php
        require_once "app/resources/views/login.php";
        require_once "app/resources/views/register.php";
        require_once "app/resources/views/alert.php";
        
    ?>
    

    <div id="load" class="load">
        <svg width="300" height="120" id="clackers">
        <!-- Left arc path -->
        <svg>
            <path id="arc-left-up" fill="none" d="M 90 90 A 90 90 0 0 1 0 0"/>
        </svg>
        <!-- Right arc path -->
        <svg>
            <path id="arc-right-up" fill="none" d="M 100 90 A 90 90 0 0 0 190 0"/>
        </svg>
        
        <text x="150" y="50" fill="#ffffff" font-family="Helvetica Neue,Helvetica,Arial" font-size="18"
                text-anchor="middle">
            L O A D I N G
        </text>
        <circle cx="15" cy="15" r="15">
            <!-- I used a python script to calculate the keyPoints and keyTimes based on a quadratic function. -->
            <animateMotion dur="1.5s" repeatCount="indefinite"
            calcMode="linear"
            keyPoints="0.0;0.19;0.36;0.51;0.64;0.75;0.84;0.91;0.96;0.99;1.0;0.99;0.96;0.91;0.84;0.75;0.64;0.51;0.36;0.19;0.0;0.0;0.05;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0"
            keyTimes="0.0;0.025;0.05;0.075;0.1;0.125;0.15;0.175;0.2;0.225;0.25;0.275;0.3;0.325;0.35;0.375;0.4;0.425;0.45;0.475;0.5;0.525;0.55;0.575;0.6;0.625;0.65;0.675;0.7;0.725;0.75;0.775;0.8;0.825;0.85;0.875;0.9;0.925;0.95;0.975;1.0">
            <mpath xlink:href="#arc-left-up"/>
            </animateMotion>
        </circle>
        <circle cx="135" cy="105" r="15" />
        <circle cx="165" cy="105" r="15" />
        <circle cx="95" cy="15" r="15">
            <animateMotion dur="1.5s" repeatCount="indefinite"
            calcMode="linear"
            keyPoints="0.0;0.0;0.05;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0;0.0;0.19;0.36;0.51;0.64;0.75;0.84;0.91;0.96;0.99;1.0;0.99;0.96;0.91;0.84;0.75;0.64;0.51;0.36;0.19;0.0"
            keyTimes="0.0;0.025;0.05;0.075;0.1;0.125;0.15;0.175;0.2;0.225;0.25;0.275;0.3;0.325;0.35;0.375;0.4;0.425;0.45;0.475;0.5;0.525;0.55;0.575;0.6;0.625;0.65;0.675;0.7;0.725;0.75;0.775;0.8;0.825;0.85;0.875;0.9;0.925;0.95;0.975;1.0">
            <mpath xlink:href="#arc-right-up"/>
            </animateMotion>
        </circle>
        </svg>
    </div>

    <div id="dashboard">


    <!-- days sourced from: https://nationaldaycalendar.com/february/ -->
    <h1  style="width:100%;align-self:center;text-align:center;display:flex;justify-content:center">
    <select  id="monthSelector">
        <option value="" selected>select Month</option>
        <option value="1">January</option>
        <option value="2" >February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
    </select>
    <select  id="yearSelector">
        <
        <option value="2020">2020</option>
        <option value="2021">2021</option>
        <option value="2022">2022</option>
        <option value="2023">2023</option>
        <option value="2024" selected>2024</option>
        <option value="2025">2025</option>
        <option value="2026">2026</option>
        <option value="2027">2027</option>
        <option value="2028">2028</option>
        <option value="2029">2029</option>
        <option value="2030">2030</option>
    </select>
    </h1>
    
    
    <ul id="loaddata">
        <!-- <li data-datetime="2022-02-01"><time >1</time><img class="img" src="app/resources/icon/plus.gif" alt="">Dark Chocolate Day </li>
        <li data-datetime="2022-02-02"><time >2</time><img class="img" src="app/resources/icon/plus.gif" alt="">Dark Chocolate Day </li>
        <li data-datetime="2022-02-03"><time >3</time><img class="img" src="app/resources/icon/plus.gif" alt="">Dark Chocolate Day </li>
        <li data-datetime="2022-02-04"><time >4</time><img class="img" src="app/resources/icon/plus.gif" alt="">Dark Chocolate Day </li>
        <li data-datetime="2022-02-05"><time >5</time><img class="img" src="app/resources/icon/plus.gif" alt="">Dark Chocolate Day </li>
        <li data-datetime="2022-02-06"><time >6</time><img class="img" src="app/resources/icon/plus.gif" alt="">Dark Chocolate Day </li>
        <li data-datetime="2022-02-07"><time >7</time><img class="img" src="app/resources/icon/plus.gif" alt="">Dark Chocolate Day </li> -->
    </ul>
    <div id="table" class="none" style="display:flex;flex-direction:column;align-items:center;justify-content:center">

        <table>
        <caption style="font-size:20px;font-weight:bolder">Monthly savings</caption>
            <thead>
                <tr>
                <th>Hour</th>
                <th>title</th>
                <th>description</th>
                <th>function</th>
                </tr>
            </thead>
            <tbody id="tramos">
                
            </tbody>
        </table>
    </div>
    <div id="form">
        <h3>Agregar  - in la Fecha <span style="color:green" id="agregaEn"></span></h3> 
        <div style="display:flex;width:80%">

            <input class="input" type="text" style="width:100%" id="title" placeholder="Title">
        </div>
        <div style="display:flex;width:80%">
        <select  id="time" multiple size="1" style="width:50%">
            
            
            
            
            
            
        </select>
            <textarea name="" style="width:50%" id="description" cols="30" rows="10" placeholder="Descripcion (optional)"></textarea>
        </div>
        <!-- <input type="text" id="descripcion" placeholder="Descripcion"> -->
        <img id="close" src="app/resources/icon/close.png" alt="">
        <div style="width:100%;display:flex;flex-direction:column;align-items:center">

            <button id="btn_insert" style="width:40%" >Agregar</button>
            
            
        </div>
    </div>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="app/resources/js/globalVaribale.js"></script>
<script src="app/resources/js/cookies.js"></script>
<script src="app/resources/js/listtime.js"></script>
<script src="app/resources/js/auth.js"></script>
<script src="app/resources/js/open.js"></script>
<script src="app/resources/js/alert.js"></script>
<script src="app/resources/js/insertNote.js"></script>
<script src="app/resources/js/signup.js"></script>
<script src="app/resources/js/login.js"></script>
<script src="app/resources/js/logout.js"></script>
<script src="app/resources/js/delete.js"></script>
<script src="app/resources/js/loaddata.js"></script>
<script src="app/resources/js/views.js"></script>
</html>