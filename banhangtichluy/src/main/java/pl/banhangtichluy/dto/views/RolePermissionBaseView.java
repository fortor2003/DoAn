package pl.banhangtichluy.dto.views;

public interface RolePermissionBaseView {
    Long getId();
    RoleBaseView getRole();
    PermissionBaseView getPermission();
}
