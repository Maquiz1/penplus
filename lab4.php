<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            outline: none;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: #def2f1;
            font-family: 'Ubuntu', sans-serif;
        }

        .container {
            width: 460px;

            height: 100%;
            background-color: #3aafa9;
            border-radius: 5px;
            text-align: center;
            padding: 10px;
            box-shadow: 0.25em 0.25em 0.75em rgba(23, 37, 42, 0.25),
                0.125em 0.125em 0.25em rgba(23, 37, 42, 0.75);
        }

        header {
            font-size: 35px;
            font-weight: 600;
            color: #def2f1;
            margin: 0 0 30px 0;
        }

        .container-body {
            display: flex;
            height: 100%;
        }

        .form-outer {
            width: 100%;
            overflow: hidden;
        }

        form {
            display: flex;
            width: 400%;
        }

        .page {
            width: 25%;
            transition: margin-left 0.3s ease-in-out;
        }

        .title {
            color: #def2f1;
            text-align: left;
            font-size: 25px;
            font-weight: 500;
        }

        .field {
            height: 45px;
            width: 330px;
            margin: 45px 0;
            position: relative;
            display: flex;
        }

        input {
            height: 100%;
            background: #def2f1;
            color: #17252a;
            text-decoration: none;
            width: 100%;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            padding-left: 15px;
        }

        .label {
            color: #17252a;
            font-size: 20px;
            position: absolute;
            top: -30px;
            font-weight: 500;
        }


        button {
            width: 100%;
            height: calc(100% + 5px);
            margin-top: -20px;
            border: none;
            background: #17252a;
            color: #def2f1;
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }

        button:hover {
            background: #def2f1;
            color: #17252a;
        }

        .btns {
            margin-top: -20px !important;
        }

        .prev {
            margin-right: 3px;
        }

        .next {
            margin-left: 3px;
        }

        select {

            padding-left: 10px;
            font-size: 17px;
            font-weight: 500;
        }

        .progress-bar {
            width: 100px;
            min-height: 100%;
            padding: 0 20px 0 5px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;

        }

        .step {
            text-align: center;
            width: 100%;
            display: flex;
            text-align: center;
            justify-content: space-between;
            position: relative;
        }

        .step-container {

            position: absolute;
            top: 0;
            right: 10px;
        }

        .step p {

            font-size: 18px;
            font-weight: 500;
            color: #def2f1;
            margin-bottom: 8px;
            transition: 0.2s;
        }

        .bullet {
            position: relative;
            height: 25px;
            width: 25px;
            border: 2px solid #def2f1;
            display: inline-block;
            font-weight: 500;
            font-size: 17px;
            border-radius: 50%;
            line-height: 25px;
            transition: 0.2s;
        }

        .step span {
            font-weight: 500;
            font-size: 17px;
            line-height: 25px;
            color: #def2f1;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .step .check {
            display: none;
            position: absolute;
            top: 8px;
            left: 8px;
            font-size: 15px;

        }

        .bullet:before,
        .bullet:after {
            position: absolute;
            content: "";
            height: 75px;
            width: 4px;
            background: #def2f1;
            bottom: -75px;
            right: 10px;
        }

        .bullet.active {
            border-color: #17252a;
            background: #17252a;
        }

        .step:last-child .bullet:before,
        .step:last-child .bullet:after {
            display: none;

        }

        .step:last-child {
            padding-bottom: 10px;
        }

        .bullet.active:after {
            background-color: #17252a;
            transform: scaleY(0);
            transform-origin: top;
            animation: animate 0.3s linear forwards;
        }

        .bullet.active span {
            display: none;
        }

        .check.active {
            display: block;
            color: #def2f1;
        }

        .step p.active {
            color: #17252a;
        }

        @keyframes animate {
            100% {
                transform: scaleY(1);
            }
        }

        @media (max-width: 450px) {

            /* For mobile phones: */
            .container {
                width: 350px;
                min-width: 260px;
            }

            .field {
                min-width: 200px;
                width: 250px
            }

            .progress-bar {
                padding: 0 0 0 5px;
            }

            button {
                font-size: 15px;
                font-weight: unset;
            }

        }
    </style>
</head>

<body>
    <div class="container">
        <header>Signup Form</header>
        <div class="container-body">
            <div class="progress-bar">
                <div class="step">
                    <p>Step</p>
                    <div class="step-container">
                        <div class="bullet"><span>1</span></div>
                        <div class="check fas fa-check"></div>
                    </div>
                </div>
                <div class="step">
                    <p>Step</p>
                    <div class="step-container">
                        <div class="bullet"><span>2</span></div>
                        <div class="check fas fa-check"></div>
                    </div>
                </div>
                <div class="step">
                    <p>Step</p>
                    <div class="step-container">
                        <div class="bullet"><span>3</span></div>
                        <div class="check fas fa-check"></div>
                    </div>
                </div>
                <div class="step">
                    <p>Step</p>
                    <div class="step-container">
                        <div class="bullet"><span>4</span></div>
                        <div class="check fas fa-check"></div>
                    </div>
                </div>
            </div>
            <div class="form-outer">
                <form action="#">
                    <div class="page slidePage">
                        <div class="title">Basic Info:</div>
                        <div class="field">
                            <div class="label">First Name</div>
                            <input type="text" />
                        </div>
                        <div class="field">
                            <div class="label">Last Name</div>
                            <input type="text" />
                        </div>
                        <div class="field nextBtn">
                            <button>Next</button>
                        </div>
                    </div>
                    <div class="page">
                        <div class="title">Contact Info:</div>
                        <div class="field">
                            <div class="label">Email address</div>
                            <input type="text" />
                        </div>
                        <div class="field">
                            <div class="label">Phone Number</div>
                            <input type="number" />
                        </div>
                        <div class="field btns">
                            <button class="prev-1 prev">Pervious</button>
                            <button class="next-1 next">Next</button>
                        </div>
                    </div>

                    <div class="page">
                        <div class="title">date of Birth:</div>
                        <div class="field">
                            <div class="label">Date</div>
                            <input type="date" />
                        </div>
                        <div class="field">
                            <div class="label">Gender</div>
                            <select>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                        <div class="field btns">
                            <button class="prev-2 prev">Pervious</button>
                            <button class="next-2 next">Next</button>
                        </div>
                    </div>

                    <div class="page">
                        <div class="title">Login Details:</div>
                        <div class="field">
                            <div class="label">Username</div>
                            <input type="text" />
                        </div>
                        <div class="field">
                            <div class="label">Password</div>
                            <input type="password" />
                        </div>
                        <div class="field btns">
                            <button class="prev-3 prev">Pervious</button>
                            <button class="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="common.js"></script>
</body>
<script>
    const slidePage = document.querySelector(".slidePage");
    const firstNextBtn = document.querySelector(".nextBtn");
    const prevBtnSec = document.querySelector(".prev-1");
    const nextBtnSec = document.querySelector(".next-1");
    const prevBtnThird = document.querySelector(".prev-2");
    const nextBtnThird = document.querySelector(".next-2");
    const prevBtnFourth = document.querySelector(".prev-3");
    const submitBtn = document.querySelector(".submit");
    const progressTexts = document.querySelectorAll(".step p");
    const progressChecks = document.querySelectorAll(".check");
    const bullets = document.querySelectorAll(".bullet");

    let max = 4;
    let current = 1;

    firstNextBtn.addEventListener("click", () => {
        slidePage.style.marginLeft = "-25%";

        bullets[current - 1].classList.add("active");
        animation = getComputedStyle(document.querySelectorAll('.bullet')[0], '::after').getPropertyValue('animation');
        console.log(animation);
        progressTexts[current - 1].classList.add("active");
        progressChecks[current - 1].classList.add("active");
        current += 1;
    })

    nextBtnSec.addEventListener("click", () => {
        slidePage.style.marginLeft = "-50%";
        bullets[current - 1].classList.add("active");
        progressTexts[current - 1].classList.add("active");
        progressChecks[current - 1].classList.add("active");
        current += 1;
    })
    nextBtnThird.addEventListener("click", () => {
        slidePage.style.marginLeft = "-75%";
        bullets[current - 1].classList.add("active");
        progressTexts[current - 1].classList.add("active");
        progressChecks[current - 1].classList.add("active");
        current += 1;
    })

    submitBtn.addEventListener("click", () => {
        slidePage.style.marginLeft = "-75%";
        bullets[current - 1].classList.add("active");
        progressTexts[current - 1].classList.add("active");
        progressChecks[current - 1].classList.add("active");
        current += 1;
        setTimeout(() => {
            alert("fuck yeahh");
            location.reload();
        }, 800);
    })

    prevBtnSec.addEventListener("click", () => {
        slidePage.style.marginLeft = "0%";
        bullets[current - 2].classList.remove("active");
        progressTexts[current - 2].classList.remove("active");
        progressChecks[current - 2].classList.remove("active");
        current -= 1;
    })
    prevBtnThird.addEventListener("click", () => {
        slidePage.style.marginLeft = "-25%";
        bullets[current - 2].classList.remove("active");
        progressTexts[current - 2].classList.remove("active");
        progressChecks[current - 2].classList.remove("active");
        current -= 1;

    })
    prevBtnFourth.addEventListener("click", () => {
        slidePage.style.marginLeft = "-50%";
        bullets[current - 2].classList.remove("active");
        progressTexts[current - 2].classList.remove("active");
        progressChecks[current - 2].classList.remove("active");
        current -= 1;
    })
</script>

</html>