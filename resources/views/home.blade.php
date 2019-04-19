@extends('layouts.app')

@section('content')

<!-- <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet"> -->




<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">



<div class="container">
    <div class = "row">

     

       @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif

     <!-- side navigation bar starts here -->

         <div class = "col-md-12">                    
          <nav id="sidebar">
            <div class="sidebar-header">
                <h3 class="text-center">
                    <i class="fas fa-tachometer-alt"></i><br>
                    Admin Panel
                </h3>

            </div>

             @if(session()->get('success'))
              <div class="alert alert-success">
                {{ session()->get('success') }}  
              </div><br />
              @endif

            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#departments1" role="tab" aria-controls="home" aria-selected="true">Departments</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#employee1" role="tab" aria-controls="profile" aria-selected="false">employees</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
              </li>
            </ul>

            <!-- for departments -->

            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="departments1" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card" style="padding:40px;">
                                <div class="top">
                                    <li class="nav-item" style="list-style-type: none;">
                                       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adddept">
                                          Add Departments
                                        </button>
                                    </li>
                                </div>
                                <br><br>
                                <table class="table table-hover" id="example">
                                    <tr class="text-info">
                                        <th>ID</th>
                                        <th>Department</th>
                                        <th>Info</th>
                                        <th>Action</th>                                       
                                    </tr>
                                    @foreach ($departments as $department)
                                    <tr>
                                         
                                        
                                        <td>
                                            {{$department->id}}
                                        </td>
                                        <td>
                                            {{$department->title}}
                                        </td>
                                        <td>
                                             {{$department->description}}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editmodal-{{$department->id}}"><i class="fas fa-edit"></i></button>
                                            
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletemodal-{{$department->id}}"><i class="fas fa-trash"></i></button>

                                           <!--  <form action="{{ route('department.destroy', $department->id)}}" method="post">
                                              @csrf
                                              @method('DELETE')
                                             <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                                            </form>  -->                                           
                                        </td>                                       
                                    </tr>


                                     @endforeach
                                  
                                   
                                </table>
                            </div>
              </div>



              <!-- MODAL TO DELETE DEPARTMENT -->

               <!-- Modal -->
               @foreach ($departments as $department)
                  <div class="modal fade" id="deletemodal-{{$department->id}}" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                         
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                         
                        </div>
                        <div class="modal-body">
                          <p>Do you really want to delete {{$department->title}}</p>
                        </div>
                        <div class="modal-footer">
                          <form action="{{ route('department.destroy', $department->id)}}" method="post">
                                              @csrf
                                              @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                          <button type="button" class="btn btn-sm btn-primary " data-dismiss="modal"><i class="fas fa-close"></i>  Close</button>

                        </div>
                      </div>
                      
                    </div>
                  </div>

                  @endforeach
                  
            



              <!---------------------------- MODAL TO ADD DEPARTMENT------------------------ -->

      <div id="adddept" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">

              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Add department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

                  <!-- modal body -->
                    <div class="modal-body">
                      <form method="post" action="{{ route('department.store') }}">
                           
                           <div class="form-group">
                              @csrf   
                              <label for="Department title ">Department Title</label>
                              <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter Title" name="title">
                            </div>

                            <div class="form-group">
                              <label for="Description">Description</label>
                              <textarea class="form-control" id="" rows="3" name="description"></textarea>
                           </div>       
                    
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-sm btn-primary" data-toggle="modal">Create department</button>

                               <a href="" class="btn btn-sm btn-icon btn-danger" data-toggle="modal" data-dismiss="modal">  Cancel</a>
                              
                            </div>

                     </form>
                  </div>

          <!-- modal body ends here -->

          </div>
        </div>
      </div>

<!-- Modal to add department  finishes here-->
            

  <!-- --------------------EDIT MODAL FOR DEPARTMENT STARTS HERE------------------- -->

      @foreach ($departments as $department)      
                <div id="editmodal-{{$department->id}}" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Modal Header</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        
                      </div>
                              <div class="modal-body">
                                  <form method="post" action="{{ route('department.update', $department->id) }}">
                                         @csrf 
                                         @method('PATCH') 

                                           <div class="form-group">  
                                              <label for="Department title ">Department Title</label>
                                              <input type="text" class="form-control" id=""   name="title" value="{{$department->title}}" type="hidden" >                                 
                                            </div>
                                          
                                          <div class="form-group">
                                            <label for="Description">Description</label>
                                            <textarea class="form-control" id="" rows="3" name="description"  type="hidden">
                                             <?php echo $department['description'] ?></textarea>
                                         </div>                                 
                                                                 
                                  
                                          <div class="modal-footer">
                                             <a href="" class="btn btn-sm btn-icon btn-danger" data-toggle="modal" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</a>

                                            <button type="submit" class="btn btn-primary">Update department</button>  
                                          </div>
                                    </form>
                              </div>
                    </div>
                  </div>
                </div>
    @endforeach

    <!-- ------------EDIT MODAL FOR DEPARTMENT ENDS HERE -------------->



<!----------------------------------- departments ends here----------------------------------- -->


  <!-------------------- employee starts here -------------------->

  <!-- --------------SHOWS ALL EMPLOYEE-------------------- -->

              <div class="tab-pane fade" id="employee1" role="tabpanel" aria-labelledby="profile-tab">
                  
                  <div class="card" style="padding:40px;">
                        <div class="top">
                           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addemployee">
                                  Add Employee
                            </button>
                        </div>
                                <br><br>

                                <table class="table table-hover">
                                    <tr class="text-info">
                                      
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Age</th>                                      
                                        <th>Mobile</th>
                                        <th>Employed for</th>                                    
                                        <th>Department</th>
                                        <th>Photo</th>                                    
                                        <th>Action</th>
                                    </tr>

                                    @foreach ($employees as $employee)
                                    <tr>                                       
                                        <td>
                                           {{$employee->id}}
                                        </td>
                                        <td>
                                          {{$employee->name}}
                                        </td>
                                        <td>
                                          {{$employee->age}}
                                        </td>
                                        <td>
                                           {{$employee->mobile_no}}
                                        </td>
                                         <td>
                                             {{$employee->join_date}}
                                        </td>
                                        <td>
                                           {{$employee->department}}
                                        </td>
                                        <td>
                                           @if($image = $employee->image()->first())
                                          <img src="{{asset($image->url) }}" class="" height="auto" width="50px">
                                           @endif
                                        </td>                                        
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editmodal-{{$employee->id}}"><i class="fas fa-edit"></i></button>
                                           
                                              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletemodal-{{$employee->id}}"><i class="fas fa-trash"></i></button>

                                        </td>
                                    </tr>
                                   @endforeach  
                                  
                                </table>
                      </div>                  
              </div>

             <!-- --------------------------- EDIT MODAL FOR EMPLOYEE----------------------------- -->


             @foreach ($employees as $employee)      
                <div id="editmodal-{{$employee->id}}" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        
                        <h4 class="modal-title">Modal Header</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                              <div class="modal-body">
                                  <form method="post" action="{{ route('employee.update', $employee->id) }}">
                                         @csrf 
                                         @method('PATCH') 

                                           <div class="form-group">  
                                              <label for="Employee name ">Employee name</label>
                                              <input type="text" class="form-control" id=""   name="name" value="{{$employee->name}}"  >                                 
                                            </div>                               
                                                                         
                                                                 
                                  
                                          <div class="modal-footer">

                                             <a href="" class="btn btn-sm btn-icon btn-danger" data-toggle="modal" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</a>

                                            <button type="submit" class="btn btn-sm btn-primary">Update Employee</button>  
                                          </div>
                                    </form>
                              </div>
                    </div>
                  </div>
                </div>
    @endforeach


    <!-- ----------------------EDIT MODAL FOR EMPLOYEE ENDS HERE------------------------ -->

    <!-- -----------------------------------DELETE MODAL FOR EMPLOYEE---------------------------- -->


  <!-- Modal -->
               @foreach ($employees as $employee)
                  <div class="modal fade" id="deletemodal-{{$employee->id}}" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                         
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                         
                        </div>
                        <div class="modal-body">
                          <p>Do you really want to delete {{$employee->name}}</p>
                        </div>
                        <div class="modal-footer">
                          <form action="{{ route('employee.destroy', $employee->id)}}" method="post">
                                              @csrf
                                              @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                          <button type="button" class="btn btn-sm btn-primary " data-dismiss="modal"><i class="fas fa-close"></i>  Close</button>

                        </div>
                      </div>
                      
                    </div>
                  </div>

                  @endforeach



    <!-- ------------------------------------------DELETE MODAL FOR EMPLOYEE ENDS HERE-------------------- -->

              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
            </div>           
        </nav>
    </div>  








<!-- -------------------------------Modal to add employee ---------------------------------->

<div class="modal fade" id="addemployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Add Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <!-- modal body -->

      <div class="modal-body">
        <form method="post" action="{{ route('employee.store') }}" enctype="multipart/form-data">
             @csrf   
             <div class="form-group">               
                <label for="employee name ">Name</label>
                <input type="text" class="form-control" id="" placeholder="Enter name" name="name">
             </div>
             <div class="form-group">               
                <label for="employee dob ">DOB</label>
                <input type="date" class="form-control" id="" placeholder="DOB" name="dob">
             </div>
             <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="Gender">Gender</label>
              </div>
              <select class="custom-select" id="gender" name="gender">
                <option selected>Choose...</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">other</option>
              </select>
            </div>

            <div class="form-group">               
                <label for="employee mobile ">Mobile</label>
                <input type="text" class="form-control" id="" placeholder="Enter mobile" name="mobile_no">
             </div>
            <div class="form-group">               
                <label for="employee email ">Email</label>
                <input type="email" class="form-control" id="" placeholder="Enter email" name="email">
             </div>
            <div class="form-group">               
                <label for="employee Address ">Address</label>
                <input type="text" class="form-control" id="" placeholder="Enter Address" name="address">
             </div>
              <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="department">Department</label>
              </div>
                
              <select class="custom-select" id="" name="department">
                <option selected>Choose...</option>
                @foreach ($departments as $department)
                <option value="{{$department->title}}">{{$department->title}}</option>
               @endforeach
              </select>
              
            </div>
             <div class="form-group">               
                <label for="employee joindate ">Join date</label>
                <input type="date" class="form-control" id="" placeholder="Enter joindate" name="join_date">
             </div>
             <div class="form-group">               
                <label for="employee about ">About</label>
                <input type="text" class="form-control" id="" placeholder="Enter Abour" name="about">
             </div>

             <div class="input-group mb-3">
              
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="photo">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
              </div>
            </div>       
      
            <div class="modal-footer">
               <a href="" class="btn btn-sm btn-icon btn-danger" data-toggle="modal" data-dismiss="modal">
                                                      <i class="fas fa-times"></i> Cancel</a>

              <button type="submit" class="btn btn-primary" data-toggle="modal">Add Employee</button>        
            </div>
       </form>
    </div>

    <!-- modal body ends here -->

  </div>
</div>
</div>

<!-- Modal to add employee  finishes here-->

               



                          <!-- department section ends here -->

                            
                        </div>

                        <!-- Page Content Holder  ends here-->
                    </div>


@endsection

