<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0">
                <?php if ($user['id']): ?>
                    <i class="fas fa-user-edit"></i> Actualizar Usuario: <b><?php echo htmlspecialchars($user['name']) ?></b>
                <?php else: ?>
                    <i class="fas fa-user-plus"></i> Crear Nuevo Usuario
                <?php endif ?>
            </h3>
        </div>
        <div class="card-body">

            <form method="POST" enctype="multipart/form-data" action="">
                <div class="form-group">
                    <label><i class="fas fa-user"></i> Nombre</label>
                    <input name="name" value="<?php echo htmlspecialchars($user['name']) ?>"
                           class="form-control <?php echo $errors['name'] ? 'is-invalid' : '' ?>" 
                           placeholder="Ingrese el nombre completo">
                    <div class="invalid-feedback">
                        <?php echo $errors['name'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-at"></i> Usuario</label>
                    <input name="username" value="<?php echo htmlspecialchars($user['username']) ?>"
                           class="form-control <?php echo $errors['username'] ? 'is-invalid' : '' ?>" 
                           placeholder="Entre 6 y 16 caracteres">
                    <div class="invalid-feedback">
                        <?php echo $errors['username'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-envelope"></i> Email</label>
                    <input name="email" type="email" value="<?php echo htmlspecialchars($user['email']) ?>"
                           class="form-control <?php echo $errors['email'] ? 'is-invalid' : '' ?>" 
                           placeholder="ejemplo@correo.com">
                    <div class="invalid-feedback">
                        <?php echo $errors['email'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-phone"></i> Teléfono</label>
                    <input name="phone" value="<?php echo htmlspecialchars($user['phone']) ?>"
                           class="form-control <?php echo $errors['phone'] ? 'is-invalid' : '' ?>" 
                           placeholder="+1234567890">
                    <div class="invalid-feedback">
                        <?php echo $errors['phone'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-globe"></i> Sitio Web</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">http://</span>
                        </div>
                        <input name="website" value="<?php echo htmlspecialchars($user['website']) ?>"
                               class="form-control <?php echo $errors['website'] ? 'is-invalid' : '' ?>" 
                               placeholder="ejemplo.com">
                    </div>
                    <div class="invalid-feedback">
                        <?php echo $errors['website'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-image"></i> Imagen</label>
                    <div class="custom-file">
                        <input name="picture" type="file" class="custom-file-input" id="customFile" accept="image/*">
                        <label class="custom-file-label" for="customFile">Seleccionar imagen...</label>
                    </div>
                    <?php if (isset($user['extension']) && $user['id']): ?>
                        <small class="form-text text-muted mt-2">
                            <i class="fas fa-info-circle"></i> Imagen actual: 
                            <img src="users/images/<?php echo $user['id'] ?>.<?php echo $user['extension'] ?>" 
                                 alt="Imagen actual" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px; margin-left: 10px;">
                        </small>
                    <?php endif; ?>
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                    <a href="index.php" class="btn btn-secondary btn-lg ml-2">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
            
            <script>
                // Actualizar el label del archivo seleccionado
                document.querySelector('.custom-file-input').addEventListener('change', function(e) {
                    var fileName = e.target.files[0]?.name || 'Seleccionar imagen...';
                    var nextSibling = e.target.nextElementSibling;
                    nextSibling.innerText = fileName;
                });
            </script>
        </div>
    </div>
</div>
