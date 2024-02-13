document.getElementById('cp').addEventListener('click', function () {
        // Get the code content
        var codeContent = document.getElementById('codeSnippet').textContent.replace(/^\d+\.\s/g, '');

        // Create a temporary textarea element
        var textarea = document.createElement('textarea');
        textarea.value = codeContent;

        // Append the textarea to the document
        document.body.appendChild(textarea);

        // Select the content of the textarea
        textarea.select();

        // Copy the selected text
        document.execCommand('copy');

        // Remove the temporary textarea
        document.body.removeChild(textarea);

        // Alert the user (You can replace this with any other action)
        alert('Code copied to clipboard!');
    });
	
	
	
	
	document.getElementById('cp1').addEventListener('click', function () {
        // Get the code content
        var codeContent1 = document.getElementById('codeSnippet1').innerText;

        // Create a temporary textarea element
        var textarea1 = document.createElement('textarea');
        textarea1.value = codeContent1

        // Append the textarea to the document
        document.body.appendChild(textarea1);

        // Select the content of the textarea
        textarea1.select();

        // Copy the selected text
        document.execCommand('copy');

        // Remove the temporary textarea
        document.body.removeChild(textarea1);

        // Alert the user (You can replace this with any other action)
        alert('Code copied to clipboard!');
    });
	
	
	
	document.getElementById('cp2').addEventListener('click', function () {
        // Get the code content
        var codeContent2 = document.getElementById('codeSnippet2').innerText;

        // Create a temporary textarea element
        var textarea2 = document.createElement('textarea');
        textarea2.value = codeContent2

        // Append the textarea to the document
        document.body.appendChild(textarea2);

        // Select the content of the textarea
        textarea2.select();

        // Copy the selected text
        document.execCommand('copy');

        // Remove the temporary textarea
        document.body.removeChild(textarea2);

        // Alert the user (You can replace this with any other action)
        alert('Code copied to clipboard!');
    });