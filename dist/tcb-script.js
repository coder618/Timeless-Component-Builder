/**
 * Load media uploader on pages with our custom metabox
 */
jQuery(document).ready(function($) {
	"use strict";

	// Instantiates the variable that holds the media library frame.
	var metaImageFrame;

	// Runs when the media button is clicked.
	// $("body").click(function(e) {

	$("body").on("click", "button.media-uplooad-btn", function(e) {
		// Get the btn
		// console.log("clicked");
		// var btn = e.target;

		// Check if it's the upload button
		// if (!btn || !$(btn).attr("data-media-uploader-target")) return;

		// // Get the field target
		// var field = $(this).data("media-uploader-target");

		// // Prevents the default action from occuring.
		// e.preventDefault();

		// check if "data-media-uploader-target" attribute present
		// if ($(this).attr("data-media-uploader-target")) {
		e.preventDefault();
		// var targetInputField = $(this).attr("name");

		var $btn = $(this);

		// Sets up the media library frame
		metaImageFrame = wp.media.frames.metaImageFrame = wp.media({
			title: "Upload File",
			button: { text: "Use this file" },
		});

		// Runs when an image is selected.
		metaImageFrame.on("select", function() {
			// Grabs the attachment selection and creates a JSON representation of the model.
			var media_attachment = metaImageFrame
				.state()
				.get("selection")
				.first()
				.toJSON();

			// Sends the attachment URL to our custom image input field.
			// $(targetInputField).val(media_attachment.url);
			// console.log(
			// 	"Target > ",
			// 	targetInputField,
			// 	" url >",
			// 	media_attachment.url,
			// );
			$btn.parents(".single-field-wrapper")
				.find("input")
				.attr("value", media_attachment.url);

			// $btn.parents(".single-field-wrapper")
			// 	.find(".selected-file")
			// 	.text(media_attachment.url);

			$btn.parents(".single-field-wrapper")
				.find(".selected-file")
				.text(media_attachment.url);
		});

		// Opens the media library frame.
		metaImageFrame.open();
	});

	/**
	 * Repeater
	 */
	// #post
	$(document).ready(function() {
		$("#post").repeater({
			initEmpty: false,
			show: function() {
				$(this).slideDown();
				$(this)
					.find(".selected-file")
					.html("");
			},

			hide: function(deleteElement) {
				if (confirm("Are you sure you want to delete this element?")) {
					$(this).slideUp(deleteElement);
				}
			},

			isFirstItemUndeletable: false,
		});
	});
});
