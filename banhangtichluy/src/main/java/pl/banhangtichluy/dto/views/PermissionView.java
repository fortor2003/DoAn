package pl.banhangtichluy.dto.views;

import java.util.Date;

public interface PermissionView extends PermissionBaseView {
    String getNote();
    Date getCreatedAt();
    Date getUpdatedAt();
}
