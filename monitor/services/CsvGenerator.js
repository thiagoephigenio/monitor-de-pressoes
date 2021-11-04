var csvFileData = [
    ['Alan Walker', 'Singer', 'Singer', 'Singer', 'Singer', 'Singer', 'Singer', 'Singer', 'Singer'],
    ['Cristiano Ronaldo', 'Footballer', 'Footballer', 'Footballer', 'Footballer', 'Footballer', 'Footballer', 'Footballer', 'Footballer']
 ];
   
 //create a user-defined function to download CSV file 
 function download_csv_file() {
 
     //define the heading for each row of the data
     var csv = 'Data/Hora,DP101,DP102,DP103,DP104,DP105,DP106,DP107,DP108\n';
     
     //merge the data with CSV
     csvFileData.forEach(function(row) {
             csv += row.join(',');
             csv += "\n";
     });
  
     //display the created CSV data on the web browser 
     document.write(csv);
 
    
     var hiddenElement = document.createElement('a');
     hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
     hiddenElement.target = '_blank';
     
     //provide the name for the CSV file to be downloaded
     hiddenElement.download = 'Famous Personalities.csv';
     hiddenElement.click();
 }