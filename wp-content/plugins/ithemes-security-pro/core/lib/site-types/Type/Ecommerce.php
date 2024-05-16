<?php

namespace iThemesSecurity\Lib\Site_Types\Type;

use iThemesSecurity\Exception\Invalid_Argument_Exception;
use iThemesSecurity\Lib\Site_Types\Question\Client_Question_Pack;
use iThemesSecurity\Lib\Site_Types\Question\End_Users_Question_Pack;
use iThemesSecurity\Lib\Site_Types\Has_End_Users;
use iThemesSecurity\Lib\Site_Types\Question;
use iThemesSecurity\Lib\Site_Types\Question\Login_Security_Question_Pack;
use iThemesSecurity\Lib\Site_Types\Templating_Site_Type;

final class Ecommerce implements Templating_Site_Type, Has_End_Users {
	const TEMPLATES = [
		Question::SELECT_END_USERS,
		Question::END_USERS_TWO_FACTOR,
		Question::END_USERS_PASSWORD_POLICY,
	];

	public function get_slug(): string {
		return self::ECOMMERCE;
	}

	public function get_title(): string {
		return __( 'eCommerce', 'it-l10n-ithemes-security-pro' );
	}

	public function get_description(): string {
		return __( 'A website to sell products or services.', 'it-l10n-ithemes-security-pro' );
	}

	public function get_icon(): string {
		return 'money';
	}

	public function get_questions(): array {
		return array_merge(
			( new Client_Question_Pack() )->get_questions(),
			( new End_Users_Question_Pack( $this ) )->get_questions(),
			( new Login_Security_Question_Pack( $this ) )->get_questions()
		);
	}

	public function get_end_users_group_label(): string {
		return __( 'Customers', 'it-l10n-ithemes-security-pro' );
	}

	public function is_supported_question( string $question_id ): bool {
		return in_array( $question_id, self::TEMPLATES, true );
	}

	public function make_prompt( string $question_id ): string {
		switch ( $question_id ) {
			case Question::SELECT_END_USERS:
				return __( 'Select your customers', 'it-l10n-ithemes-security-pro' );
			case Question::END_USERS_TWO_FACTOR:
				return __( 'Do you want to secure your customer accounts with two-factor authentication?', 'it-l10n-ithemes-security-pro' );
			case Question::END_USERS_PASSWORD_POLICY:
				return __( 'Do you want to secure your customer accounts with a password policy?', 'it-l10n-ithemes-security-pro' );
			default:
				throw new Invalid_Argument_Exception( sprintf( 'The eCommerce site type does not support the %s question.', $question_id ) );
		}
	}

	public function make_description( string $question_id ): string {
		switch ( $question_id ) {
			case Question::SELECT_END_USERS:
			case Question::END_USERS_TWO_FACTOR:
			case Question::END_USERS_PASSWORD_POLICY:
				return '';
			default:
				throw new Invalid_Argument_Exception( sprintf( 'The eCommerce site type does not support the %s question.', $question_id ) );
		}
	}
}