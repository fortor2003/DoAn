package pl.banhangtichluy.dto.views;

import java.util.Date;

public interface UserView extends UserBaseView {
    String getEmail();
    String getPhone();
    String getNote();
    Date getCreatedAt();
    Date getUpdatedAt();
}
