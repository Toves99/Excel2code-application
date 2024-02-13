document.addEventListener('DOMContentLoaded', function () {
  var languagesdiv = document.getElementById('languagesdiv');
  var resizableHandle = document.getElementById('resizable-handle');
  var container = document.getElementById('container');
  var isResizing = false;
  var initialWidth;
  var initialMouseX;

  resizableHandle.addEventListener('mousedown', function (e) {
    isResizing = true;
    initialWidth = languagesdiv.offsetWidth;
    initialMouseX = e.clientX;
    document.addEventListener('mousemove', handleMouseMove);
    document.addEventListener('mouseup', handleMouseUp);
  });

  function handleMouseMove(e) {
    if (isResizing) {
      var newWidth = initialWidth + (initialMouseX - e.clientX);
      languagesdiv.style.width = newWidth + 'px';

      // Check if languagesdiv has reached or overlapped container
      var languagesdivRect = languagesdiv.getBoundingClientRect();
      var containerRect = container.getBoundingClientRect();

      if (languagesdivRect.right >= containerRect.left) {
        // If languagesdiv has reached or overlapped container, adjust the margin of container
        container.style.marginLeft = containerRect.left - languagesdivRect.right + 'px';
      } else {
        // If not overlapped, reset the margin of container
        container.style.marginLeft = '0';
      }
    }
  }

  function handleMouseUp() {
    isResizing = false;
    document.removeEventListener('mousemove', handleMouseMove);
    document.removeEventListener('mouseup', handleMouseUp);
  }
});