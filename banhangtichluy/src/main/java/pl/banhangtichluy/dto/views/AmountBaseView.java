package pl.banhangtichluy.dto.views;

import pl.banhangtichluy.enums.AmountType;

import java.util.Date;

public interface AmountBaseView {
    Long getId();
    String getType();
    String getCode();
    Integer getValue();
}
