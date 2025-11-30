<?php

namespace App\Http\Enums;


use App\Traits\CollectedEnum;

enum GatewayEnum: int
{
    use CollectedEnum;

    case YIGIM = 1;
    case BIRBANK = 2;
    case BIRBANK_INSTALLMENT = 3;
    case LEO = 4;
    case UBANK = 5;
    case ABB = 6;
    case UZCARD = 1001;
    case PAYMTECH = 2001;

    public function label(): string {
        return static::getLabel($this);
    }

    public static function getLabel(self $value): string {
        return match ($value) {
            GatewayEnum::BIRBANK => 'kapital',
            GatewayEnum::YIGIM => 'yigim',
            GatewayEnum::BIRBANK_INSTALLMENT => 'kapital_installment',
            GatewayEnum::LEO => 'leo',
            GatewayEnum::UBANK => 'ubank',
            GatewayEnum::ABB => 'abb',
            GatewayEnum::UZCARD => 'uzcard',
            GatewayEnum::PAYMTECH => 'paymtech',
        };
    }

    public static function getLabelById(?int $id): ?string {
        return match ($id) {
            GatewayEnum::BIRBANK->value => 'kapital',
            GatewayEnum::YIGIM->value => 'yigim',
            GatewayEnum::BIRBANK_INSTALLMENT->value => 'kapital_installment',
            GatewayEnum::LEO->value => 'leo',
            GatewayEnum::UBANK->value => 'ubank',
            GatewayEnum::ABB->value => 'abb',
            GatewayEnum::UZCARD->value => 'uzcard',
            GatewayEnum::PAYMTECH->value => 'paymtech',

            default => null
        };
    }
}

