package pl.banhangtichluy.dto.views;

import java.util.Date;

public interface RolePermissionView extends RolePermissionBaseView{
    String getNote();
    Date getCreatedAt();
    Date getUpdatedAt();
}
