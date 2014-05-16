myImage = document.getElementById("mainImage");

imageArray = ["../img/photo.png", "../img/photoevent2.jpg"];

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


