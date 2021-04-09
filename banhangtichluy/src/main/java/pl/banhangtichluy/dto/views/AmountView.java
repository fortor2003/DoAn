package pl.banhangtichluy.dto.views;

import java.util.Date;

public interface AmountView extends AmountBaseView {
    String getFirstName();
    String getLastName();
    String getEmail();
    String getPhone();
    String getNote();
    Date getCreatedAt();
    Date getUpdatedAt();
    UserBaseView getCreatedBy();
    UserBaseView getUpdatedBy();
}
