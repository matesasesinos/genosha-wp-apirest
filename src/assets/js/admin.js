(function ($) {
  $(document).ready(function () {
    $(".api-help-title").on("click", function () {
      const content = $(this).parent().find(".api-help-content");
      content.toggle("fast");
    });
  });
  $(document).ready(function () {
    $("#api-generate-auth").on("click", function () {
      const key = $.trim($("#api-generate-key").val());
      if (key.length < 1) {
        alert("Debe proporcionar datos");
        return;
      }
      const keyGenerate = btoa(key);
      $("#api-auth").css("display", "inline-block");
      $("#api-key-generate").text(keyGenerate);
      $("#api-key-generate-example").text(keyGenerate);
    });
  });
  $(document).ready(function () {
    if ($("#skybox-messages").is(":visible")) {
      setTimeout(() => {
        $("#skybox-messages").hide();
      }, 4000);
    }
  });
})(jQuery);
