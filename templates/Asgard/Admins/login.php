<div class="card login-card">
    <div class="card-body">
        <div class="login-brand d-flex justify-content-center align-items-center pb-5">Asgard v5</div>
        <!-- <div class="login-welcome-back d-flex justify-content-center align-items-center">Welcome Back!</div> -->
        <?= $this->Form->create(null, ['role'=>'form']); ?>
            <div class="form-group">
                <input type="text" name="username" class="form-control custom-input" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control custom-input" placeholder="Password">
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn custom-submit">Login</button>
            </div>
        </form>
    </div>
</div>
