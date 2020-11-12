$("#profile_img").change(function () {
	$("#crop_canvas, .crop_btn").show();
	var canvas  = $("#crop_canvas"),
    context = canvas.get(0).getContext("2d");
	
	if(this.files && this.files[0])
	{
		canvas.cropper('destroy');
		var reader = new FileReader();
		reader.onload = function (evt) {
			var img = new Image();
			img.onload = function () {
				context.canvas.height = img.height;
				context.canvas.width = img.width;
				context.drawImage(img, 0, 0);
				var cropper = canvas.cropper({
					viewMode: 2
				});
				var form = document.getElementById("profile_img").form;
				$(form).submit(function() {
					var imageData = canvas.cropper('getImageData');
					var imgWidth = (imageData.naturalWidth > 600) ? 600 : imageData.naturalWidth;
					var imgHeight = (imageData.naturalHeight > 400) ? 400 : imageData.naturalHeight;
					if(imgWidth >= imgHeight)
					{
						imgHeight = (imgHeight * 23) / 55;
					}
					else if(imgHeight > imgWidth)
					{
						imgWidth = (imgWidth * 55) / 23;
					}
					
					// Get a string base 64 data url
					var croppedImageDataURL = canvas.cropper('getCroppedCanvas', {
						width: imgWidth,
						height: imgHeight,
						imageSmoothingEnabled: false,
						imageSmoothingQuality: 'high',
					  }).toDataURL("image/png"); 
					$("#profile_img_thumb").val(croppedImageDataURL);
				});
				
				$("#button_toggle").change(function() {
					if($(this).is(':checked'))
					{
						canvas.cropper('enable');
					}
					else
					{
						canvas.cropper('disable');
					}
				});
				setTimeout(function(){
					canvas.cropper('disable');
				}, 1000);
			};
			img.src = evt.target.result;
		};
		reader.readAsDataURL(this.files[0]);
	}
});