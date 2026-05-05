$(document).ready(function(){
    console.log("DOM volledig geladen...");

    $("#discord-btn").click(function() {
      window.open("https://discord.gg/JxUmW5kc", "_blank");
    });

    $("#doc-btn").click(function() {
      window.open("./document.php", "_blank");
    });

    $("#dept-btn").click(function() {
      window.open("./teams.php", "_self");
    });
});