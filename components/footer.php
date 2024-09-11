<footer>
  <div class="bg-gray-800 text-white">
    <div class="container mx-auto py-4 px-5 flex justify-center items-center">
      <p class="text-sm text-center">© <?php date('Y') ?> Tailwebs. | Designed By —
        <a href="https://ashish.toolsmug.com" class="text-rose-600 ml-1" target="_blank">Ashish</a>
      </p>
    </div>
  </div>
</footer>

<!-- Model for Image Viewing -->
<div id="ImageViewModal" class="hidden z-50 fixed top-0 left-0 p-5 md:p-20 w-screen h-screen overflow-y-scroll overflow-hidden bg-[#666666b0]">
  <div class="flex flex-col items-center justify-center gap-6">
    <button type="button" onclick="$('#ImageViewModal').fadeOut(200)" class="px-3 py-1 bg-gray-600 text-white hover:bg-gray-600 focus:bg-gray-500 font-bold rounded border shadow">Close</button>
    <img id="largeImageViewer" src="" class="w-full md:w-[80%] h-fit border-2 border-white rounded-lg">
  </div>
</div>
<script>
  $('.viewInLarge').click(function() {
    let image = $(this).attr('src');
    $('#largeImageViewer').attr('src', image);
    $('#ImageViewModal').fadeIn(200);
  })
</script>
<script src="lib/js/sweetalert.js"></script>