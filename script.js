myImage = document.getElementById("mainImage");

imageArray = ["../img/snow-woods16-9.jpg", "../img/river16-9.jpg", "../img/flowers16-9.jpg", "../img/boston-skyline2.jpeg"];

imageIndex = 0;

function changeImage() {
	myImage.setAttribute("src", imageArray[imageIndex]);
	imageIndex++;
	if (imageIndex >= imageArray.length) {
		imageIndex = 0;
	}
}

var intervalHandle = setInterval(changeImage, 4000);

myImage.onclick = function () {
	clearInterval(intervalHandle);
}


