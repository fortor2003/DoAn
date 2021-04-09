package pl.banhangtichluy.dto.views;

import pl.banhangtichluy.enums.AmountType;

public interface TransactionBaseView {
    Long getId();
    String getCode();
    Integer getBeforeValue();
    Integer getPlusValue();
    Integer getAfterValue();
}
