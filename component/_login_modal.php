<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login your iDiscuss</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="component/_handleLogin.php" method="POST">
            <div class="modal-body">

                    <div class="mb-3">
                        <label for="loginInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="loginInputEmail1" aria-describedby="emailHelp" name="u_email">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="loginInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginInputPassword1" name="u_pass">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Login</button>
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                </div>
            </form>


        </div>
    </div>
</div>