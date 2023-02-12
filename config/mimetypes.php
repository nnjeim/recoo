<?php

return [
	'aggregate_types' => [
		'image' => [
			'mime_types' => [
				'image/jpeg',
				'image/jpeg',
				'image/png',
				'image/gif',
				'image/tiff',
				'image/tiff',
				'image/bmp',
				'image/vnd.adobe.photoshop',
			],
			'extensions' => [
				'jpg',
				'jpeg',
				'png',
				'gif',
				'tif',
				'tiff',
				'bmp',
				'psd',
			],
		],
		'vector' => [
			'mime_types' => [
				'image/vnd.dwg',
				'image/vnd.dxf',
				'image/svg+xml',
			],
			'extensions' => [
				'dwg',
				'dxf',
				'svg',
			],
		],
		'pdf' => [
			'mime_types' => [
				'application/pdf',
			],
			'extensions' => [
				'pdf',
			],
		],
		'audio' => [
			'mime_types' => [
				'audio/aac',
				'audio/ogg',
				'audio/oga',
				'audio/mp3',
				'audio/wav',
			],
			'extensions' => [
				'aac',
				'ogg',
				'oga',
				'mp3',
				'wav',
			],
		],
		'video' => [
			'mime_types' => [
				'video/mp4',
				'video/mpeg',
				'video/ogg',
				'video/webm',
			],
			'extensions' => [
				'mp4',
				'm4v',
				'mov',
				'ogv',
				'webm',
			],
		],
		'archive' => [
			'mime_types' => [
				'application/zip',
				'application/x-compressed-zip',
				'multipart/x-zip',
			],
			'extensions' => [
				'zip',
			],
		],
		'document' => [
			'mime_types' => [
				'application/msword',
				'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
				'text/plain',
				'application/plain',
				'text/xml',
				'text/json',
				'application/json',
			],
			'extensions' => [
				'doc',
				'docx',
				'txt',
				'text',
				'xml',
				'json',
			],
		],
		'spreadsheet' => [
			'mime_types' => [
				'application/vnd.ms-excel',
				'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
			],
			'extensions' => [
				'xls',
				'xlsx',
			],
		],
		'presentation' => [
			'mime_types' => [
				'application/vnd.ms-powerpoint',
				'application/vnd.openxmlformats-officedocument.presentationml.presentation',
				'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
			],
			'extensions' => [
				'ppt',
				'pptx',
				'ppsx',
			],
		],
	],
];
