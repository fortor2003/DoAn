package pl.banhangtichluy.dto.views;

import java.util.Date;

public interface RoleView extends RoleBaseView {
    String getNote();
    Date getCreatedAt();
    Date getUpdatedAt();
}
