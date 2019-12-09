<?php
	use Mainclass\Models\Rol;

	function traducirRol($id){
		$rol = new Rol();
		$rol = $rol->find($id);
		return $rol->nombre;
	}	

	function cropAlign($image, $cropWidth, $cropHeight, $horizontalAlign = 'center', $verticalAlign = 'middle') {
	    $width = imagesx($image);
	    $height = imagesy($image);
	    $horizontalAlignPixels = calculatePixelsForAlign($width, $cropWidth, $horizontalAlign);
	    $verticalAlignPixels = calculatePixelsForAlign($height, $cropHeight, $verticalAlign);
	    return imageCrop($image, [
	        'x' => $horizontalAlignPixels[0],
	        'y' => $verticalAlignPixels[0],
	        'width' => $horizontalAlignPixels[1],
	        'height' => $verticalAlignPixels[1]
	    ]);
	}

	function calculatePixelsForAlign($imageSize, $cropSize, $align) {
	    switch ($align) {
	        case 'left':
	        case 'top':
	            return [0, min($cropSize, $imageSize)];
	        case 'right':
	        case 'bottom':
	            return [max(0, $imageSize - $cropSize), min($cropSize, $imageSize)];
	        case 'center':
	        case 'middle':
	            return [
	                max(0, floor(($imageSize / 2) - ($cropSize / 2))),
	                min($cropSize, $imageSize),
	            ];
	        default: return [0, $imageSize];
	    }
	}