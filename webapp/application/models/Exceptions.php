<?php

/*Sign up form*/
class BlankFirstNameException extends Exception
{}

class BlankLastNameException extends Exception
{}

class BlankSexException extends Exception
{}

class BlankAddressException extends Exception
{}

class BlankContactException extends Exception
{}

class BlankEmailException extends Exception
{}

class InvalidOrganizationException extends Exception
{}

class BlankUserNameException extends Exception
{}

class UnavailableUserNameException extends Exception
{}

class BlankPasswordException extends Exception
{}

class ConfirmPasswordException extends Exception
{}

/*Login form*/
class UserInvalidException extends Exception
{}

class UserPasswordInvalidException extends Exception
{}

/*add course form*/
class BlankCourseCodeException extends Exception
{}

class BlankCourseNameException extends Exception
{}

class BlankDurationException extends Exception
{}

class BlankCategoryException extends Exception
{}

/*enrollment form*/
class UnavailableEnrollmentException extends Exception
{}

class BlankEnrollmentException extends Exception
{}

/*organization enrollment form*/
class EnrollmentException extends Exception
{}

/*check validity*/
class InactiveException extends Exception
{}

class DeletedException extends Exception
{}

class ModelDoesNotExistException extends Exception
{}

/*add organization form*/
class BlankNameException extends Exception
{}

class BlankOrgAddressException extends Exception
{}

class BlankTelephoneException extends Exception
{}

class BlankOrgEmailException extends Exception
{}

/*FTP course upload*/
class FTPException extends Exception
{}
