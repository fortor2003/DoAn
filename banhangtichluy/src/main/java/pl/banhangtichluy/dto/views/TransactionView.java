package pl.banhangtichluy.dto.views;

import java.util.Date;

public interface TransactionView extends TransactionBaseView{
    String getNote();
    Date getCreatedAt();
    Date getUpdatedAt();
    AmountBaseView getAmount();
    UserBaseView getCreatedBy();
    UserBaseView getUpdatedBy();
}
