function handleFiles(files) {
    const fileNames = [];

    for (const file of files) {
        // Your existing code to display file info in the list

        // Store the file name without extension in the array
        const fileNameWithoutExtension = file.name.split('.').slice(0, -1).join('.');
        fileNames.push(fileNameWithoutExtension);
    }

    // Set the hidden input field value to the list of file names
    document.getElementById('file-names').value = fileNames.join(',');
}