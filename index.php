	


<html lang="en">    

<title> Convert Excel File To JSON </title>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.6/xlsx.full.min.js"></script>
    
    <script>
        $(document).ready(function(){
              
              var raw_file_data;
              var placeholders; // placeholders are column headers

              $("#fileUploader").change(function(evt){
                    var selectedFile = evt.target.files[0];
                    var reader = new FileReader();
                   
                    reader.onload = function(event) {
                      var data = event.target.result;
                      var workbook = XLSX.read(data, {
                          type: 'binary'
                      });

                      workbook.SheetNames.forEach(function(sheetName) {
              							var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);

              							raw_file_data = XL_row_object;

              							//Sheet loaded
              							initLayout();
                        })
                    };

                    reader.onerror = function(event) {
                      console.error("File could not be read! Code " + event.target.error.code);
                    };

                    reader.readAsBinaryString(selectedFile);
              });


              function initLayout(){
              	initPlaceholders();
              }


              function initPlaceholders(){
              	placeholders = Object.keys(raw_file_data[0]); 
              	
              	for (var i = 0; i < placeholders.length; i++) {
              		console.log(placeholders[i]);
              	}

				       document.getElementById("jsonObject").innerHTML = JSON.stringify(raw_file_data);
               
              }
        });
    </script>

</head>

<body>

    <input type="file" id="fileUploader" name="fileUploader" accept=".xls, .xlsx"/>
    </br></br>
    <label id="jsonObject"> JSON : </label>
</body>

