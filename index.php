<?php
require 'authCheck.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'components/meta.php'; ?>
  <title>Dashboard <?php echo site_name; ?></title>

</head>

<body class="overflow-hidden">

  <section class="flex max-h-screen">
    <section class="relative flex flex-col overflow-x-hidden overflow-y-auto w-full">

      <!-- main content -->
      <main>

        <section class="min-h-screen flex flex-col bg-gray-200">

          <!-- Daily Todo -->
          <?php $sql = "select * from students where user_id=$user->id order by createdAt desc";
          $res = $conn->query($sql);
          $row = $res->num_rows;
          ?>
          <section class="py-20">
            <div class="container flex flex-col w-full max-w-2xl">
              <div class="flex py-2 justify-between items-center">
                <h2 class="text-2xl text-red-600 font-bold">Tailwebs.</h2>
                <div class="flex justify-between items-center gap-5">
                  <button onclick="$('#modifyUser').fadeIn(200)" class="px-3 py-1 bg-white text-blue-600 font-bold text-sm rounded-lg"><i class="bi bi-person-fill"></i> <?php echo $user->name; ?></button>
                  <a href="logout.php" class="px-3 py-1 bg-white text-red-600 font-bold text-sm rounded-lg"><i class="bi bi-x-circle-fill"></i> Logout</a>
                </div>
              </div>
              <div class="flex justify-between rounded-t items-center bg-blue-600 text-white px-4 py-2">
                <h3 class="font-bold flex gap-2 items-center"><i class="bi bi-person"></i> Students</h3>
                <div class="flex gap-2 items-center">
                  <a href="javascript:void(0)" onclick="$('#addStudentModal').fadeIn(200);" class="px-1 py-.5 bg-white text-blue-600 font-bold text-2xl rounded-lg"><i class="bi bi-plus square-fill"></i></a>
                  <!-- <i onclick="$('#dailyTodoView').slideToggle(200); $(this).toggleClass('rotate-180')" class="cursor-pointer bi bi-chevron-down transition-all"></i> -->
                </div>
              </div>

              <div class="rounded-b overflow-x-auto p-4 bg-white border shadow text-sm">
                <table id="studentTable" class="cell-border table-auto w-96 md:w-full rounded transition-all">
                  <thead class="bg-gray-200">
                    <tr>
                      <th class="text-start">
                        S.N
                      </th>
                      <th class="text-start">
                        Name
                      </th>
                      <th class="text-start">
                        Subject
                      </th>
                      <th class="text-start">
                        Marks
                      </th>
                      <th class="text-start">
                        Action
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($res->num_rows > 0) {
                      $count = 0;
                      while ($row = $res->fetch_assoc()) {
                        $count++;
                    ?>

                        <tr>
                          <td><?php echo $count ?></td>
                          <td>
                            <h6 class="font-semibold"><?php echo ucfirst($row['name']) ?></h6>
                          </td>
                          <td>
                            <?php echo $row['subject'] ?>
                          </td>
                          <td>
                            <?php echo $row['marks'] ?>
                          </td>
                          <td>
                            <a href="javascript:void(0)" onclick="modifyStudent('<?php echo ucfirst($row['id']) ?>', '<?php echo ucfirst($row['name']) ?>', '<?php echo ucfirst($row['subject']) ?>', '<?php echo ucfirst($row['marks']) ?>')" class="text-blue-600 hover:text-blue-900 hover:font-semibold py-1 px-2 rounded"><i class="bi bi-pencil-square"></i></a>
                            <a href="javascript:void(0)" onclick="deleteStudent('<?php echo ucfirst($row['id']) ?>')" class="text-red-600 hover:text-red-900 hover:font-semibold py-1 px-2 rounded"><i class="bi bi-trash"></i></a>
                          </td>
                        </tr>
                    <?php
                      }
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Modal for Adding Student -->
            <div id="addStudentModal" class="hidden z-50 fixed top-0 left-0 p-5 md:p-20 w-screen h-screen overflow-hidden bg-[#6666666e]">
              <div class="flex items-center justify-center">
                <form id="addStudent" class="relative w-full max-w-lg bg-white rounded-xl shadow-lg px-5 border flex flex-col divide-y divide-gray-300">
                  <h5 class="py-3 text-lg font-semibold">Add Student</h5>
                  <div class="flex flex-col py-5 gap-4">
                    <div class="relative z-0 w-full">
                      <input title="name" type="text" name="name" id="name" class="rounded border px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent appearance-none focus:outline-none focus:ring-0 peer" placeholder=" " required>
                      <label for="name" class="peer-focus:font-medium absolute duration-300 transform -translate-y-4 scale-75 left-4 peer-focus:left-4 top-5 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">Name</label>
                    </div>
                    <div class="relative z-0 w-full">
                      <input title="subject" type="text" name="subject" id="subject" class="rounded border px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent appearance-none focus:outline-none focus:ring-0 peer" placeholder=" " required>
                      <label for="subject" class="peer-focus:font-medium absolute duration-300 transform -translate-y-4 scale-75 left-4 peer-focus:left-4 top-5 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">Subject</label>
                    </div>
                    <div class="relative z-0 w-full">
                      <input title="marks" min="1" max="100" type="number" name="marks" id="marks" class="rounded border px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent appearance-none focus:outline-none focus:ring-0 peer" placeholder=" " required>
                      <label for="marks" class="peer-focus:font-medium absolute duration-300 transform -translate-y-4 scale-75 left-4 peer-focus:left-4 top-5 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">Marks</label>
                    </div>
                  </div>
                  <div class="flex gap-2 py-5 w-full justify-end">
                    <button type="button" onclick="$('#addStudentModal').fadeOut(200)" class="px-3 py-1 bg-red-400 text-white hover:bg-red-600 focus:bg-red-600 font-bold rounded border shadow">Cancel</button>
                    <button type="submit" class="px-3 py-1 bg-sky-500 text-white hover:bg-sky-600 focus:bg-sky-600 font-bold rounded border shadow">Submit</button>
                  </div>
                </form>
              </div>
            </div>

            <!-- Modal for Editing Student -->
            <div id="editStudentModal" class="hidden z-50 fixed top-0 left-0 p-5 md:p-20 w-screen h-screen overflow-hidden bg-[#6666666e]">
              <div class="flex items-center justify-center">
                <form id="editStudent" class="relative w-full max-w-lg bg-white rounded-xl shadow-lg px-5 border flex flex-col divide-y divide-gray-300">
                  <h5 class="py-3 text-lg font-semibold">Modify Student</h5>
                  <div class="flex flex-col py-5 gap-4">
                    <div class="relative z-0 w-full">
                      <input title="name" type="text" name="name" id="name" class="rounded border px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent appearance-none focus:outline-none focus:ring-0 peer" placeholder=" " required>
                      <label for="name" class="peer-focus:font-medium absolute duration-300 transform -translate-y-4 scale-75 left-4 peer-focus:left-4 top-5 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">Name</label>
                    </div>
                    <div class="relative z-0 w-full">
                      <input title="subject" type="text" name="subject" id="subject" class="rounded border px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent appearance-none focus:outline-none focus:ring-0 peer" placeholder=" " required>
                      <label for="subject" class="peer-focus:font-medium absolute duration-300 transform -translate-y-4 scale-75 left-4 peer-focus:left-4 top-5 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">Subject</label>
                    </div>
                    <div class="relative z-0 w-full">
                      <input title="marks" min="1" max="100" type="number" name="marks" id="marks" class="rounded border px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent appearance-none focus:outline-none focus:ring-0 peer" placeholder=" " required>
                      <label for="marks" class="peer-focus:font-medium absolute duration-300 transform -translate-y-4 scale-75 left-4 peer-focus:left-4 top-5 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">Marks</label>
                    </div>
                    <input type="text" id="student_id" name="id" class="hidden">
                  </div>
                  <div class="flex gap-2 py-5 w-full justify-end">
                    <button type="button" onclick="$('#editStudentModal').fadeOut(200)" class="px-3 py-1 bg-gray-400 text-white hover:bg-gray-500 focus:bg-gray-500 font-bold rounded border shadow">Cancel</button>
                    <button type="submit" class="px-3 py-1 bg-sky-500 text-white hover:bg-sky-600 focus:bg-sky-600 font-bold rounded border shadow">Update</button>
                  </div>
                </form>
              </div>
            </div>

            <!-- Modal for Editing User Details -->
            <div id="modifyUser" class="hidden z-50 fixed top-0 left-0 p-5 md:p-20 w-screen h-screen overflow-hidden bg-[#6666666e]">
              <div class="flex items-center justify-center">
                <form id="editUser" class="relative w-full max-w-lg bg-white rounded-xl shadow-lg px-5 border flex flex-col divide-y divide-gray-300">
                  <h5 class="py-3 text-lg font-semibold">Modify User</h5>
                  <div class="flex flex-col py-5 gap-4">
                    <div class="relative z-0 w-full bg-gray-200">
                      <input title="username" value="<?php echo $user->username; ?>" type="text" readonly id="username" class="rounded border border-gray-800 px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" ">
                      <label for="username" class="peer-focus:font-medium absolute duration-300 transform -translate-y-4 scale-75 left-4 peer-focus:left-4 top-5 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">Username</label>
                    </div>
                    <div class="relative z-0 w-full">
                      <input title="name" type="text" value="<?php echo $user->name; ?>" name="name" id="name" class="rounded border border-gray-800 px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                      <label for="name" class="peer-focus:font-medium absolute duration-300 transform -translate-y-4 scale-75 left-4 peer-focus:left-4 top-5 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">Full Name</label>
                    </div>
                    <div class="relative z-0 w-full">
                      <input title="Password" type="password" name="password" id="password" class="rounded border border-gray-800 px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" ">
                      <label for="password" class="peer-focus:font-medium absolute duration-300 transform -translate-y-4 scale-75 left-4 peer-focus:left-4 top-5 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">Password</label>
                    </div>
                  </div>
                  <div class="flex gap-2 py-5 w-full justify-end">
                    <button type="button" onclick="$('#modifyUser').fadeOut(200)" class="px-3 py-1 bg-gray-400 text-white hover:bg-gray-500 focus:bg-gray-500 font-bold rounded border shadow">Cancel</button>
                    <button type="submit" class="px-3 py-1 bg-sky-500 text-white hover:bg-sky-600 focus:bg-sky-600 font-bold rounded border shadow">Update</button>
                  </div>
                </form>
              </div>
            </div>


          </section>



        </section>

      </main>



      <!-- Footer -->
      <?php include 'components/footer.php'; ?>
    </section>
  </section>
  <script>
    $('#addStudent').submit(function(e) {
      e.preventDefault();
      let formData = $(this).serializeArray();
      Swal.showLoading();
      $.post('api/student-add.php', formData,
        function(data) {
          if (data.success === false) {
            Swal.fire({
              icon: 'error',
              text: `${data.message}`,
              width: 300
            })
          } else {
            $('#addStudent')[0].reset();
            Swal.fire({
              icon: 'success',
              text: `${data.message}`,
              width: 300,
            }).then(() => location.reload());
          }
        }).fail(function(err) {
        Swal.fire({
          icon: 'error',
          text: `${err.responseText}`,
          width: 300
        });
      });

    })

    function modifyStudent(id, name, subject, marks) {
      $('#editStudent').find('#name').val(name);
      $('#editStudent').find('#student_id').val(id);
      $('#editStudent').find('#subject').val(subject);
      $('#editStudent').find('#marks').val(marks);
      $('#editStudentModal').fadeIn(200);
    }

    $('#editStudent').submit(function(e) {
      e.preventDefault();
      let formData = $(this).serializeArray();
      Swal.showLoading();
      $.post('api/student-edit.php', formData,
        function(data) {
          if (data.success === false) {
            Swal.fire({
              icon: 'error',
              text: `${data.message}`,
              width: 300
            })
          } else {
            Swal.fire({
              icon: 'success',
              text: `${data.message}`,
              width: 300,
            }).then(() => location.reload());
          }
        }).fail(function(err) {
        Swal.fire({
          icon: 'error',
          text: `${err.responseText}`,
          width: 300
        });
      });

    })

    $('#editUser').submit(function(e) {
      e.preventDefault();
      let formData = $(this).serializeArray();
      Swal.showLoading();
      $.post('api/user-edit.php', formData,
        function(data) {
          if (data.success === false) {
            Swal.fire({
              icon: 'error',
              text: `${data.message}`,
              width: 300
            })
          } else {
            Swal.fire({
              icon: 'success',
              text: `${data.message}`,
              width: 300,
            }).then(() => location.reload());
          }
        }).fail(function(err) {
        Swal.fire({
          icon: 'error',
          text: `${err.responseText}`,
          width: 300
        });
      });

    })

    function deleteStudent(id) {
      Swal.fire({
        icon: 'info',
        width: 300,
        text: 'Do you want to Delete?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        focusCancel: true,
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.showLoading();
          $.post('api/student-delete.php', {
              id
            },
            function(data) {
              if (data.success === false) {
                Swal.fire({
                  icon: 'error',
                  text: `${data.message}`,
                  width: 300
                })
              } else {
                Swal.fire({
                  icon: 'success',
                  text: `${data.message}`,
                  width: 300,
                }).then(() => location.reload());
              }
            }).fail(function(err) {
            Swal.fire({
              icon: 'error',
              text: `${err.responseText}`,
              width: 300
            });
          });

        }
      })
    }

    $('#studentTable').DataTable({
      dom: 'Blfrtip',
      buttons: [{
          extend: 'excel',
          className: 'bg-gray-600 text-white px-3 py-1 mb-2 hover:bg-gray-700 text-sm'
        },
        {
          extend: 'csv',
          className: 'bg-gray-600 text-white px-3 py-1 mb-2 hover:bg-gray-700 text-sm'
        },
        {
          extend: 'pdf',
          className: 'bg-gray-600 text-white px-3 py-1 mb-2 hover:bg-gray-700 text-sm'
        },
      ],
      order: [
        [0, 'asc']
      ]
    });
  </script>
</body>

</html>