$(document).ready(function(){
         
  load_data();
 
  function load_data(query1)
  {
   $.ajax({
    url:"../php/search_user.php",
    method:"POST",
    data:{query:query1},
    dataType:"json",
    success:function(data)
    {
      $('#total_records').text(data.length);
     var html = '';
     if (data.length > 0) {
      for (var count = 0; count < data.length; count++) {
          html += '<tr>';
          html += '<td>' + data[count].id + '</td>';
          html += '<td>' + data[count].username + '</td>';
          html += '<td>' + data[count].used_points + '</td>';
          html += '<td>' + data[count].reward_id + '</td>';
          html += '<td>' + data[count].redemption_date + '</td>';
          html += '<td>';
          html += '<div class="edit-delete">';
          html += '<button alt="Remove User" class="delete" data-username="' + htmlspecialchars(data[count].username) + '">';
          html += '<img src="../assets/icons/delete/delete_base.svg" width="20px" height="20px">';
          html += '</button>';
          html += '</div>';
          html += '</td>';            
          html += '</tr>';
      }
     }
     else
     {
      html = '<tr><td colspan="5">No Data Found</td></tr>';
     }
     $('tbody').html(html);
    }
   })
  }
 
  $('#searchForm').submit(function (e) {
    e.preventDefault();
    var query1 = $('#tags').val();
    load_data(query1);
});

  $('#search-btn').click(function () {
      var query1 = $('#tags').val();
      console.log('Search button clicked with query:', query1); // Add this line
      load_data(query1);
  });

  $("#tags").change(function () {
      var query1 = $('#tags').val();
      console.log('Input value changed to:', query1); // Add this line
      load_data(query1);
  });
});

function htmlspecialchars(str) {
var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
};
return str.replace(/[&<>"']/g, function (m) {
    return map[m];
});
}

/*$(document).ready(function () {
  load_data();

  function load_data(query1) {
      $.ajax({
          url: "../php/search_user.php",
          method: "POST",
          data: { query: query1 },
          dataType: "json",
          success: function (data) {
              $('#total_records').text(data.length);
              var html = '';

              if (data.length > 0) {
                  html += '<tr>';
                  html += '<th>ID</th>';
                  html += '<th>Username</th>';
                  html += '<th>Used Points</th>';
                  html += '<th>Rewards Code</th>';
                  html += '<th>Redemption Date</th>';
                  html += '</tr>';

                  for (var count = 0; count < data.length; count++) {
                      html += '<tr>';
                      html += '<td>' + data[count].id + '</td>';
                      html += '<td>' + data[count].username + '</td>';
                      html += '<td>' + data[count].used_points + '</td>';
                      html += '<td>' + data[count].reward_id + '</td>';
                      html += '<td>' + data[count].redemption_date + '</td>';            
                      html += '</tr>';
                  }
              } else {
                  html = '<tr><td colspan="5">No Data Found</td></tr>';
              }

              $('tbody').html(html);
          }
      });
  }

  $('#searchForm').submit(function (e) {
    e.preventDefault();
    var query1 = $('#tags').val();
    load_data(query1);
  });

  $('#search-btn').click(function () {
    var query1 = $('#tags').val();
    console.log('Search button clicked with query:', query1);
    load_data(query1);
  });

  $("#tags").change(function () {
    var query1 = $('#tags').val();
    console.log('Input value changed to:', query1);
    load_data(query1);
  });
});
*/


/*$(document).ready(function () {
  load_data();

  function load_data(query1) {
      $.ajax({
          url: "../php/search_user.php",
          method: "POST",
          data: { query: query1 },
          dataType: "json",
          success: function (data) {
              $('#total_records').text(data.length);
              var html = '';

              if (data.length > 0) {
                  html += '<tr>';
                  html += '<th>Username</th>';
                  html += '<th>Phone Number</th>';
                  html += '<th>Email Address</th>';
                  html += '<th>Points</th>';
                  html += '<th>Actions</th>';
                  html += '</tr>';

                  for (var count = 0; count < data.length; count++) {
                      html += '<tr>';
                      html += '<td>' + data[count].username + '</td>';
                      html += '<td>' + data[count].phone_num + '</td>';
                      html += '<td>' + data[count].email + '</td>';
                      html += '<td>' + data[count].points + '</td>';
                      html += '<td>';
                      html += '<div class="edit-delete">';
                      html += '<button alt="Remove User" class="delete" data-username="' + htmlspecialchars(data[count].username) + '">';
                      html += '<img src="../assets/icons/delete/delete_base.svg" width="20px" height="20px">';
                      html += '</button>';
                      html += '</div>';
                      html += '</td>';
                      html += '</tr>';
                  }
              } else {
                  html = '<tr><td colspan="5">No Data Found</td></tr>';
              }

              $('#userTable').html(html);
          }
      });
  }

  // Use event delegation for dynamically created buttons
  $('#userTable').on('click', '.delete', function () {
      var username = $(this).data('username');
      // Handle the delete action using the username
      console.log('Delete button clicked for user:', username);
      // Add your delete logic here
  });

  $('#searchForm').submit(function (e) {
      e.preventDefault();
      var query1 = $('#tags').val();
      load_data(query1);
  });

  $('#search-btn').click(function () {
      var query1 = $('#tags').val();
      console.log('Search button clicked with query:', query1);
      load_data(query1);
  });

  $("#tags").change(function () {
      var query1 = $('#tags').val();
      console.log('Input value changed to:', query1);
      load_data(query1);
  });
});
function htmlspecialchars(str) {
  var map = {
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#039;'
  };
  return str.replace(/[&<>"']/g, function (m) {
      return map[m];
  });
}*/


/*$(document).ready(function(){
  load_data();

  function load_data(query1) {
      $.ajax({
          url: "../php/search_user.php",
          method: "POST",
          data: {query: query1},
          dataType: "json",
          success: function(data) {
              $('#total_records').text(data.length);
              var html = '';

              if (data.length > 0) {
                html += '<tr>';
                html += '<th>Username</th>';
                html += '<th>Phone Number</th>';
                html += '<th>Email Address</th>';
                html += '<th>Points</th>';
                html += '<th>Actions</th>';
                html += '</tr>';
      
                for (var count = 0; count < data.length; count++) {
                  var row = '<tr>';
                  row += '<td>' + data[count].username + '</td>';
                  row += '<td>' + data[count].phone_num + '</td>';
                  row += '<td>' + data[count].email + '</td>';
                  row += '<td>' + data[count].points + '</td>';
                  row += '<td>';
                  row += '<div class="edit-delete">';
                  row += '<button alt="Remove User" class="delete" data-username="' + (data[count].username ? htmlspecialchars(data[count].username) : '') + '">';
                  row += '<img src="../assets/icons/delete/delete_base.svg" width="20px" height="20px">';
                  row += '</button>';
                  row += '</div>';
                  row += '</td>';
                  row += '</tr>';

                  html += row;
                }
              } else {
                html = '<tr><td colspan="5">No Data Found</td></tr>';
              }
      

              $('#userTable').html(html);
          }
      });
  }

  $('#searchForm').submit(function (e) {
      e.preventDefault();
      var query1 = $('#tags').val();
      load_data(query1);
  });

    $('#search-btn').click(function () {
        var query1 = $('#tags').val();
        console.log('Search button clicked with query:', query1); // Add this line
        load_data(query1);
    });

    $("#tags").change(function () {
        var query1 = $('#tags').val();
        console.log('Input value changed to:', query1); // Add this line
        load_data(query1);
    });
});

function htmlspecialchars(str) {
  var map = {
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#039;'
  };
  return str.replace(/[&<>"']/g, function (m) {
      return map[m];
  });
}*/
