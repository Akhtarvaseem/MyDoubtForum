

<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Register Your first Your iDiscuss</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="component/_handleSignup.php" method='POST'>
            <div class="modal-body">

                    <div class="mb-3">
                        <label for="signupInputName" class="form-label">Enter Name</label>
                        <input type="text" class="form-control" id="signupInputName" aria-describedby="emailHelp" name="uname" >
                        
                    </div>
                    
                    <div class="mb-3">
                        <label for="signupInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="signupInputEmail1" aria-describedby="emailHelp" name="uemail" >
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                   

                    <div class="mb-3">
                        <label for="signupInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="signupInputPassword1" name="password">
                    </div>

                    <div class="mb-3">
                        <label for="signupInputcPassword1" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="signupInputcPassword1" name="cpassword">
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Register</button>
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                </div>
            </form>
      
    </div>
  </div>
</div>