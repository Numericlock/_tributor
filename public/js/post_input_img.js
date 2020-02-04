var file_array = [];
var reader_array  = [];
var preview_array = [];
var files = [];
function previewFiles() {
	console.log(files);
	if(file_array.length<4){
		var input_file_length = document.querySelector('input[type=file]').files.length;
		var file_length = document.querySelector('input[type=file]').files.length + file_array.length;
		for(var i=0; i<input_file_length; i++){
			file_array.push(document.querySelector('input[type=file]').files[i]);
			reader_array.push(new FileReader());
		}
		create_imgArea(file_length);
	}
}

function remove_previewFile(t){
	var id=$(t).attr("id").substr(8,1)
	file_array.splice(id,1);
	preview_array.splice(id,1);
	files.splice(id,1);
	$(t).attr('src',"");
	create_imgArea(file_array.length);
}
function create_imgArea(length){
	//なぜかfor文回せない。
	console.log()
	reader_array  = [];
	preview_array = [];
	for(var i=0; i<length; i++){
		preview_array.push(document.querySelector('img[id="preview-' + i + '"]'));
	}
	for(var i=0; i<length; i++){
		reader_array.push(new FileReader());
		reader_array[i].readAsDataURL(file_array[i]);
	}
	if(length>0){
		reader_array[0].addEventListener("load", function () {
			preview_array[0].src = reader_array[0].result;
			files[0] = reader_array[0].result;
		}, false);
	}

	if(length>1){
		reader_array[1].addEventListener("load", function () {
			preview_array[1].src = reader_array[1].result;
			files[1] = reader_array[1].result;
		}, false);
	}

	if(length>2){
		reader_array[2].addEventListener("load", function () {
			preview_array[2].src = reader_array[2].result;
			files[2] = reader_array[2].result;
		}, false);
	}

	if(length>3){
		reader_array[3].addEventListener("load", function () {
			preview_array[3].src = reader_array[3].result;
			files[3] = reader_array[3].result;
		}, false);
	}
	switch(length){
		case 0:
			$("#preview-0, #preview-1, #preview-2, #preview-3").css({
				'display':'none'
			});
			break;
		case 1:
			$(".post-modal-inputFiles-left").css({
				'display':'block',
				'width':'100%'
			});
			$(".post-modal-inputFiles-right").css({
				'display':'none'
			});
			$("#preview-0").css({
				'display':'block',
				'width':'100%',
				'height':'300px',
				'object-fit':'cover'
			});
			$("#preview-1, #preview-2, #preview-3").css({
				'display':'none'
			});
			break;
		case 2:
			$(".post-modal-inputFiles-left,.post-modal-inputFiles-right").css({
				'display':'block',
				'width':'50%',
			});
			$("#preview-0,#preview-1").css({
				'display':'block',
				'width':'100%',
				'height':'300px',
				'object-fit':'cover'
			});
			$("#preview-2, #preview-3").css({
				'display':'none'
			});
			break;
		case 3:
			$(".post-modal-inputFiles-left,.post-modal-inputFiles-right").css({
				'display':'block',
				'width':'50%',
			});
			$("#preview-0").css({
				'display':'block',
				'width':'100%',
				'height':'300px',
				'object-fit':'cover'
			});
			$("#preview-1,#preview-2").css({
				'display':'block',
				'width':'100%',
				'height':'150px',
				'object-fit':'cover'
			});
			$("#preview-3").css({
				'display':'none'
			});

			break;
		case 4:
			$(".post-modal-inputFiles-left,.post-modal-inputFiles-right").css({
				'display':'block',
				'width':'50%',
			});
			$("#preview-0,#preview-1,#preview-2,#preview-3").css({
				'display':'block',
				'width':'100%',
				'height':'150px',
				'object-fit':'cover'
			});
			break;
	}
}