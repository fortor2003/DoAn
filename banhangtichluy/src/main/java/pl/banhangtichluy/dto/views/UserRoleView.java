package pl.banhangtichluy.dto.views;

import java.util.Date;

public interface UserRoleView extends UserRoleBaseView{
    String getNote();
    Date getCreatedAt();
    Date getUpdatedAt();
}
