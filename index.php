<DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>US Quiz</title>
	<style>
            @import url("css/style.css");

     </style> 
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js" ></script> 
	<script>
		$(document).ready(function(){
			
			var score = 0;
			var attempts = localStorage.getItem("totalAttempts");

		    $("#congrats").html(""); //resets congratulations message

			$("button").on("click", gradeQuiz);

			 $(".q5Choice").on("click", function() {
                    $(".q5Choice").css("background", "");
                    $(this).css("background", "rgb(193, 207, 220)");
                    $(this).css("border-radius", "20px")
                });

			 $(".q8Choice").on("click", function() {
                    $(".q8Choice").css("background", "");
                    $(this).css("background", "rgb(193, 207, 220)");
                    $(this).css("border-radius", "300em")
                   

                });
			displayQ4Choices();
			displayQ7Choices();



			function displayQ4Choices(){
                    let q4ChoicesArray = ["Maine", "Rhode Island", "Maryland", "Delaware"];
                    q4ChoicesArray = _.shuffle(q4ChoicesArray);
                    
                    for(let i = 0; i < q4ChoicesArray.length; i++) {
                        $("#q4Choices").append(` <input type="radio" name="q4" id="${q4ChoicesArray[i]}" 
                        	value="${q4ChoicesArray[i]}"> <label for =="${q4ChoicesArray[i]}">${q4ChoicesArray[i]}</label>`);
                    }
                }


            function displayQ7Choices(){
            	let q7ChoicesArray = ["Alaska", "California", "Texas", "Hawaii"];
            	q7ChoicesArray = _.shuffle(q7ChoicesArray);

            	for(let i = 0; i < q7ChoicesArray.length; i++)
            	{
            		$("#q7Choices").append(` <input type="radio" name="q7" id="${q7ChoicesArray[i]}" 
                        	value="${q7ChoicesArray[i]}"> <label for =="${q7ChoicesArray[i]}">${q7ChoicesArray[i]}</label>`);
            	}
            }

			function isFormValid()
			{
				let isValid = true;
				if ($("#q1").val() == "")
				{
					isValid= false;
					$("#validationFbdk").html("Question 1 was not answered");

				}

				return isValid;
			}

			function rightAnswer(index)
			{
				$(`#q${index}Feedback`).html("Correct");
				$(`#q${index}Feedback`).attr("class", "bg-success text-white");
				$(`#markImg${index}`).html("<img src = 'img/check.png' alt = 'checkmark' height='50px'>");
				score += 10;

			}

			function wrongAnswer(index)
			{
				$(`#q${index}Feedback`).html("Incorrect");
				$(`#q${index}Feedback`).attr("class", "bg-danger text-white");
				$(`#markImg${index}`).html("<img src = 'img/xmark.png' alt ='xmark' height='50px'>");
				
			}

			function gradeQuiz() //calls gradeQuiz from the onclick listener
			{
				$("#validationFbdk").html(""); // resets validation feedback

				if(!isFormValid())
				{
					return;
				}

				score = 0;
				let q1Response = $("#q1").val().toLowerCase();
				let q2Response = $("#q2").val();
				let q4Response = $("input[name=q4]:checked").val();
				let q6Response = $("#q6").val().toLowerCase();
				let q7Response = $("input[name=q7]:checked").val();
			    let q10Repsone = $("#q10").val();

				if(q1Response == "sacramento")
				{
					rightAnswer(1);

				}
				else
				{
					wrongAnswer(1);
				}

				if(q2Response == "mo")
				{
					rightAnswer(2);

				}
				else
				{
					wrongAnswer(2);
				}

				//question 3
				if($("#Jefferson").is(":checked") && $("#Roosevelt").is(":checked") 
                        && !$("#Jackson").is(":checked") && !$("#Franklin").is(":checked")){
                        rightAnswer(3);
                    } else {
                        wrongAnswer(3);
                    }

                //question 4

                if (q4Response == "Rhode Island")
                {
                	rightAnswer(4);
                }
                else
                {
                	wrongAnswer(4);
                }
				

				//question 5
				if($("#seal2").css("background-color") == "rgb(193, 207, 220)") {
                        rightAnswer(5);
                    } else {
                        wrongAnswer(5);
                    }

                 //question 6
                 if (q6Response == "george washington")
                 {
                 	rightAnswer(6);
                 }
                 else
                 {
                 	wrongAnswer(6);
                 }

                 //question 7
                 if (q7Response == "Alaska")
                 {
                 	rightAnswer(7);

                 }
                 else
                 {
                 	wrongAnswer(7);
                 }


                 //question 8

                if($("#bear").css("background-color") == "rgb(193, 207, 220)") {
                        rightAnswer(8);
                    } else {
                        wrongAnswer(8);
                    }

                //question 9

                if($("#Mississippi").is(":checked") && $("#Missouri").is(":checked") 
                        && $("#Colorado").is(":checked") && !$("#Wisonsin").is(":checked"))
                	{
                        rightAnswer(9);
                    } else {
                        wrongAnswer(9);
                    }

                if(q10Repsone == "gc")
                {

                	rightAnswer(10);
                }
                else
                {
                	wrongAnswer(10);
                }


                if(score < 80)
                    {
                        $("#totalScore").removeClass("text-success").addClass("text-danger");
                    } else 
                    {
                        $("#totalScore").removeClass("text-danger").addClass("text-success");
                    }

                 if(score > 80)
                    {
                    	 $("#congrats").html(`<span id="congrats" class="card-text"> Congrats! You go over 80 on the Quiz!.</span><hr>`);
                    }

                 $("#totalScore").html(`Total Score: ${score}`);

                 $("#totalAttempts").html(`Total attempts ${++attempts}`);
                    localStorage.setItem("totalAttempts", attempts);
			}
		})
	</script>
</head>

<body class="text-center">

	<h1 class="jumbotron">US Geography Quiz</h1>

	<h3><span id="markImg1"></span> 1. What is the capital of California?</h3>

	<input type="text" id="q1">
	<br><br>
	<hr> 

	<div id="q1Feedback"></div>

	<h3 id="validationFbdk" class="bg-danger text-white"></h3>

	<br>
	<h3 ><span id="markImg2"></span> 2. What is the longest river? </h3>
	<select id="q2">

		<option value=""> Select One </option>
		<option value="ms"> Mississippi</option>
		<option value="mo"> Missouri</option>
		<option value="co"> Colorado</option>
		<option value="de"> Delaware</option>

	</select>
	<br><br>
 	<hr>


	<div id="q2Feedback"> </div>
	<br>

	<h3 id="validationFbdk" class="bg-danger text-white"></h3>

	<h3><span id="markImg3"></span> 3. What presidents are carved into Mount Rushmore? </h3>
    <input type="checkbox" id="Jackson"><label for="Jackson"> A. Jackson </label>
    <input type="checkbox" id="Franklin"><label for="Franklin"> B. Franklin </label>
    <input type="checkbox" id="Jefferson"><label for="Jefferson"> T. Jefferson </label>
    <input type="checkbox" id="Roosevelt"><label for="Roosevelt"> T. Roosevelt </label>
    <br><br>
    <div id="q3Feedback" role="alert"></div>
    <hr>



	<div id="q3Feedback"></div>
	<br>

    <h3><span id="markImg4"></span> 4. What is the smallest US State? </h3>
        <div id="q4Choices"></div>
        <br>
        <div id="q4Feedback" role="alert"></div>
        <hr>
	<br>

	<h3><span id="markImg5"></span>5. What image is in the Great Seal of the State of California? </h3>
	<img src="img/seal1.png" alt="Seal 1" class="q5Choice" id="seal1">
	<img src="img/seal2.png" alt="Seal 2" class="q5Choice" id="seal2">
	<img src="img/seal3.png" alt="Seal 3" class="q5Choice" id="seal3">
	<div id="q5Feedback"></div>
	<br>
	<hr>

	<h3><span id="markImg6"></span> 6. Who was the first President of the United States? </h3>
	<input type="text" id="q6">

	<div id="q6Feedback"></div>
	<br><br>
	<hr>

	<h3><span id="markImg7"></span>7.  What is the largest US state? </h3>

	 <div id="q7Choices" class="a"></div>
                <br>
     <div id="q4Feedback" role="alert"></div>
	<br>
	<div id="q7Feedback"></div>
	<hr>


    <h3><span id="markImg8"></span>8. What is California's official state Animal?</h3>
    <img src="img/bear.jpg" alt="bear" class="q8Choice" height= "200px" id="bear">
	<img src="img/otter.jpg" alt="otter" class="q8Choice" height= "200px" id="ptter">
	<img src="img/tiger.jpg" alt="tiger" class="q8Choice" height= "200px" id="tiger">
	<div id="q8Feedback"></div>

	<hr> 

 	<h3><span id="markImg9"></span>9. What are the three major rivers of the United States?
 		<br><br>
 	<input type="checkbox" id="Mississippi"><label for="Mississippi"> Mississippi </label>
    <input type="checkbox" id="Missouri"><label for="Missouri"> Missouri </label>
    <input type="checkbox" id="Colorado"><label for="Colorado"> Colorado </label>
    <input type="checkbox" id="Wisonsin"><label for="Wisonsin"> Wisonsin </label>
    <div id="q9Feedback"></div>
    <br><br>
    <hr> 

    <h3 ><span id="markImg10"></span>10. What Canyon is located in Arizona?  </h3>
	<select id="q10">

		<option value=""> Select One </option>
		<option value="gc"> Grand Canyon</option>
		<option value="zc"> Zion Canyon</option>
		<option value="bc"> BigHorn Canyon</option>
		<option value="ac"> Antelope Canyon</option>

	</select>

	<div id="q10Feedback"></div>

	<br><br>

	<div id="cardType" class="card-body text-red">
    <span id="congrats" class="card-text"></span>
	
	<button class="btn btn-outline-danger"> Submit Quiz </button>

 	<h2 id="totalScore" class="text-info"></h2>
</body>
</html>
